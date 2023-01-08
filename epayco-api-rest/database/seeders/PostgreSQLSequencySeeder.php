<?php

namespace Database\Seeders;

use App\Helpers\Common\Str;
use Illuminate\Database\Seeder;

class PostgreSQLSequencySeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        if(\DB::connection()->getConfig('driver') == 'pgsql')
        {
            $tables = $this->getAllTables();
            $prefix = \DB::connection()->getConfig('prefix');

            foreach($tables as $table)
            {
                \DB::select(\DB::raw('select setval(\''.$prefix.$table.'_id_seq\', (select max(id) + 1 from '.$prefix.$table.'));'));
            }
        }
    }

    public function getAllTables()
    {
        $tables = [];

        /*$result = DB::select('SHOW TABLES');*/

        $result = \DB::getDoctrineSchemaManager()->listTableNames();
        $prefix = \DB::connection()->getConfig('prefix');

        $ignore = ['migrations', 'oauth'];

        foreach($result as $table)
        {
            if(strlen($prefix) > 0)
            {
                $parts = explode($prefix, $table);//$table->Tables_in_robot_project
                if(count($parts) > 1 && !Str::customContains($ignore, $parts[1]))
                {
                    array_push($tables, $parts[1]);
                }
            }
            else
            {
                if(!Str::customContains($ignore, $table))
                {
                    array_push($tables, $table);
                }
            }
        }

        return $tables;
    }
}
