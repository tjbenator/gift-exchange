<?php

use Illuminate\Console\Command;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class ExchangeProcess extends Command {

	/**
	 * The console command name.
	 *
	 * @var string
	 */
	protected $name = 'exchange:process';

	/**
	 * The console command description.
	 *
	 * @var string
	 */
	protected $description = 'Process exchanges that have reached the \"draw at\" date.';

	/**
	 * Create a new command instance.
	 *
	 * @return void
	 */
	public function __construct()
	{
		parent::__construct();
	}

	/**
	 * Execute the console command.
	 *
	 * @return mixed
	 */
	public function fire()
	{
		foreach (Exchange::whereProcessed(false)->get() as $exchange) {
			if ($exchange->draw_at->isToday()) {
				$this->info('Drawing for exchange "' . $exchange->name . '"');
				// For each user in exchange
				$users = $exchange->participants()->orderByRaw('RAND()')->get();
				$length = count($users);
				foreach ($users as $key => $giver) {
					if ($key == $length - 1) {
						$gifty = $users[0];
					} else {
						$gifty = $users[$key + 1];
					}
					//Store
					$this->info($giver->id . ' will be giving a gift to ' . $gifty->id);
					$surprise = new Surprise;
					$surprise->gifty()->associate($gifty);
					$surprise->giver()->associate($giver);
					$exchange->surprises()->save($surprise);
					//Email
					Mail::send('emails.exchanges.drawing', array('giver' => $giver, 'gifty' => $gifty, 'exchange' => $exchange), function($message) use ($exchange, $giver)
					{
						//Test Emails
						//$message->to('test@binarypenguin.net', $giver->username)->subject($exchange->name . ' drawing!');
    					$message->to($giver->email, $giver->username)->subject($exchange->name . ' drawing!');
					});
				}

				// Mark as processed
				$exchange->processed = true;
				$exchange->save();
			} else {
				// Skip
				$this->info( $exchange->draw_at->diffInDays() . ' days left on ' . $exchange->name);
			}
		}
		$this->info('Done.');
	}

	/**
	 * Get the console command arguments.
	 *
	 * @return array
	 */
	protected function getArguments()
	{
		return [];
		// return array(
		// 	array('example', InputArgument::REQUIRED, 'An example argument.'),
		// );
	}

	/**
	 * Get the console command options.
	 *
	 * @return array
	 */
	protected function getOptions()
	{
		return [];
		// return array(
		// 	array('example', null, InputOption::VALUE_OPTIONAL, 'An example option.', null),
		// ;
	}

}
