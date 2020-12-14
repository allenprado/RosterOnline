<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class Consolidate extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'Consolidate:consolidar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command Consolidate';

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
    public function handle()
    {
      //Pegar os dados no banco
        $sql = " INSERT INTO consolidate";
        $sql .= " select CAST(a.created_at as date) as 'date', sum(a.value) as 'values'";
        $sql .= " from special_hours a";
        $sql .= " group by CAST(a.created_at as date)";

        //pega os dados no banco
        $dados = \DB::select($sql);
    }
}
