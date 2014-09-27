<?php
/**
 * Created by PhpStorm.
 * User: aleksandr
 * Date: 2/12/14
 * Time: 2:09 PM
 */

class SoftDeleteBehavior extends CActiveRecordBehavior {

    const SOFT_DELETE_BEHAVIOR = 'softDelete';

    public $tableAlias = 'label';
    /**
     * @var string specifies the name of deleted column
     */
	public $deletedColumn = 'is_deleted';

	public $deletedByColumn = 'id_deleted_by';

	public $deletedTimeColumn = 'deleted_timestamp';

    /**
     * @return CActiveRecord searches deleted items
     */
    function deleted() {
        $criteria = $this->getOwner()->getDbCriteria();
        $criteria->compare($this->tableAlias . '.' . $this->deletedColumn, 1);
        return $this->getOwner();
    }

    /**
     * @return CActiveRecord searches not deleted items
     */
    function notDeleted() {
        $criteria = $this->getOwner()->getDbCriteria();
        $criteria->compare($this->tableAlias . '.' . $this->deletedColumn, 0);
        return $this->getOwner();
    }

	/**
	* @return CActiveRecord marks item as deleted
	*/
	function destroy()
	{
		$this->getOwner()->{$this->deletedColumn} = 1;

		if ($this->getOwner()->hasAttribute($this->deletedByColumn))
		{
			$this->getOwner()->{$this->deletedByColumn} = Yii::app()->user->id;
		}

		if ($this->getOwner()->hasAttribute($this->deletedTimeColumn))
		{
			$this->getOwner()->{$this->deletedTimeColumn} = time();
		}

		return $this->getOwner();
	}

    /**
     * @return CActiveRecord marks item as restored
     */
    function restore() {
        $this->getOwner()->{$this->deletedColumn} = 0;
        return $this->getOwner();
    }

    /**
     * @return bool checks if item is deleted
     */
    function isDeleted() {
        return (bool) $this->getOwner()->{$this->deletedColumn};
    }

} 