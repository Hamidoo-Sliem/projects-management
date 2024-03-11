<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Models\GmailCredential;

class ApproveTeamMembers extends Mailable
{
	use Queueable, SerializesModels;
	protected $mailData = [];

	/**
	 * Create a new message instance.
	 *
	 * @return void
	 */
	public function __construct($mailData = [])
	{
		$this->mailData = $mailData;
	}

	/**
	 * Build the message.
	 *
	 * @return $this
	 */
	public function build()
	{
		$from = GmailCredential::find(1)->email;
		$app_name = config('custom.project_name');

		return $this->markdown('mails.ApproveTeamMembers')->with('mailData', $this->mailData)
			->from($from, $app_name)
			->subject(__('project.send_approve_team_members'))
			->replyTo('', $app_name);
	}
}