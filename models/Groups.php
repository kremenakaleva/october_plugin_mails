<?php namespace Pensoft\Mails\Models;

use Illuminate\Support\Facades\DB;
use Model;

/**
 * Model
 */
class Groups extends Model
{
    use \October\Rain\Database\Traits\Validation;
    
    use \October\Rain\Database\Traits\SoftDelete;

    protected $dates = ['deleted_at'];


    /**
     * @var string The database table used by the model.
     */
    public $table = 'pensoft_mails_groups';

    /**
     * @var array Validation rules
     */
    public $rules = [
    ];

	/**
	 * Validate goto and reply_to emails
	 */
	public function beforeSave()
	{
		$arrGoto = array();
		if ($this->goto != '') {
			$arrGoto = explode(',', $this->goto);
			foreach($arrGoto AS $gotoEmailAddress) {
				$isValid = filter_var($gotoEmailAddress, FILTER_VALIDATE_EMAIL); // boolean
				if(!$isValid){
					throw new \ValidationException([
						'goto' => $gotoEmailAddress. ' is not valid GOTO email'
					]);
				}
			}
			$arrGoto = array_map('strtolower', $arrGoto);
			$arrGoto = array_unique($arrGoto);
			$this->goto = implode(',', $arrGoto);

		}else{
			throw new \ValidationException([
				'goto' => 'Goto is required!'
			]);
		}

		$arrReply = array();
		if ($this->reply_to != '') {
			$arrReply = explode(',', $this->reply_to);
			foreach($arrReply AS $replyEmailAddress) {
				$isValid = filter_var($replyEmailAddress, FILTER_VALIDATE_EMAIL); // boolean
				if(!$isValid){
					throw new \ValidationException([
						'reply_to' => $replyEmailAddress. ' is not valid REPLY TO email'
					]);
				}
			}
			$arrReply = array_map('strtolower', $arrReply);
			$arrReply = array_unique($arrReply);
			$this->reply_to = implode(',', $arrReply);
		}


		/**
		 * Update moderators field TODO slect goto and replyto of all groups
		 */
		$allModerators = array_unique(array_merge(array('root@psweb.pensoft.net', 'messaging@pensoft.net'), $arrGoto, $arrReply));
		$allModerators = array_map('strtolower', $allModerators);
		$this->moderators = implode(',', $allModerators);
	}

	public function afterSave()
	{
		$groupEmail = $this->address;
		$groupMembers = $this->goto;
		$groupDomain = $this->domain;
		$groupModerators = $this->moderators;
		$replyTo = $this->reply_to;
		$active = $this->active;
		$accesspolicy = $this->accesspolicy;

		// TODO vmail_test -> vmail
		DB::connection('vmail')->select('SELECT * FROM updatemailgroup(\'' . $groupEmail . '\', \'' . trim($groupMembers) . '\', \'' . $groupDomain . '\',  \'' . trim($groupModerators) . '\',  \'' . trim($replyTo) . '\', ' . (int)$active . ',  \'' . trim($accesspolicy) . '\')');

		return \Redirect::refresh();
	}
}
