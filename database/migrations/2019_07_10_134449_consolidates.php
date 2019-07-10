<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class Consolidates extends Migration
{
  /**
  * Run the migrations.
  *
  * @return void
  */
  public function up()
  {
  DB::statement("
  create view consolidates as
select 1 as id,user_id,week,company_id,sum(q_hours) as q_hours,sum(vlSalary) as vl_salary
from(

select user_id,week,company_id,q_hours, (q_hours * valHour) as vlSalary from(
select
s.user_id,
WEEK(s.date) AS week,
s.company_id,
s.hourSpec,
substring(TIMEDIFF(TIMEDIFF(s.hourEnd,s.hourStart),s.breakTime),1,2) +
(substring(TIMEDIFF(TIMEDIFF(s.hourEnd,s.hourStart),s.breakTime),4,2)/60) as q_hours,
CASE
    WHEN sp.operator = '+' THEN (c.valHour + sp.value)
    WHEN sp.operator = '*' THEN (c.valHour * sp.value)
    ELSE c.valHour + sp.value
END as valHour
from shifts s
left join special_hours sp
on s.user_id = sp.user_id
and s.hourSpec = sp.id
left join companies c
on s.company_id = c.id) a) as aa
group by user_id,week,company_id
  ");
  }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
    DB::statement('DROP VIEW IF EXISTS consolidates');
    }
    }
