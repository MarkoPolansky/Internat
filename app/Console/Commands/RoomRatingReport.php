<?php

namespace App\Console\Commands;

use App\Models\Apartment;
use App\Models\AvailableOuting;
use Illuminate\Console\Command;

class RoomRatingReport extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'report:weekly';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Report hodnotenia izieb na zaklade ktorych su pridelene vychádzky';

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
     * @return int
     */
    public function handle()
    {
        $apartments =   Apartment::with('users','lastWeekRattings')->get();

        $ratingRules = [
            1 => [5 => '21:00',
                0 =>'20:30'],

            2 => [5 => '21:30',
                0 =>'21:00'],

            3 => [5=> '21:30',
                0 =>'21:00'],

            4 => [5=> '21:30',
                0 =>'21:00']
        ];


        foreach ($apartments as $apartment){
            $sumRatting =0;
            $avgRatting = 0;
            foreach ($apartment->rattings as $ratting){
                $sumRatting+=$ratting->rating;
            }
            if ($sumRatting == 0) continue;
            else
                $avgRatting = $sumRatting/$apartment->rattings->count();

            foreach ($apartment->users as $user) {
                if ($user->class)
                foreach ($ratingRules[$user->class] as $key=>$until){
                    if ($avgRatting>= $key){
                        AvailableOuting::create([
                            'user_id' => $user->id,
                            'until' => $until
                        ]);
                        break;
                    }
                }

            }

        }





    }
}
