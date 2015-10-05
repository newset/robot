<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VRobot extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::statement('
        CREATE VIEW
          v_robot_lease_log
        (
            id,
            robot_id,
            lease_type_id,
            lease_started_at,
            lease_ended_at,
            agency_id,
            hospital_id,
            memo,
            deleted_at,
            created_at,
            updated_at
        ) AS
          SELECT
            max(id) id,
            robot_id,
            lease_type_id,
            lease_started_at,
            lease_ended_at,
            agency_id,
            hospital_id,
            memo,
            deleted_at,
            created_at,
            updated_at
          FROM i_robot_lease_log
          GROUP BY robot_id;');

        DB::statement('
            CREATE VIEW
              v_robot_log
            (
                id,
                action_type_id,
                robot_id,
                employee_id,
                memo,
                deleted_at,
                created_at,
                updated_at
            ) AS
              SELECT
                max(id) id,
                action_type_id,
                robot_id,
                employee_id,
                memo,
                deleted_at,
                created_at,
                updated_at
              FROM i_robot_log
              GROUP BY robot_id;');

        DB::statement('
            CREATE VIEW
              v_robot
            (
                id,
                cust_id,
                production_date,
                employee_id,
                memo,
                deleted_at,
                created_at,
                updated_at,
                log_lease_id,
                log_lease_lease_type_id,
                log_lease_lease_started_at,
                log_lease_lease_ended_at,
                log_lease_agency_id,
                log_lease_hospital_id,
                log_lease_memo,
                log_lease_deleted_at,
                log_lease_created_at,
                log_lease_updated_at,
                log_id,
                log_action_type_id,
                log_robot_id,
                log_employee_id,
                log_memo,
                log_deleted_at,
                log_created_at,
                log_updated_at
            ) AS
              SELECT
                i.id,
                i.cust_id,
                i.production_date,
                i.employee_id,
                i.memo,
                i.deleted_at,
                i.created_at,
                i.updated_at,
                log_lease.id,
                log_lease.lease_type_id,
                log_lease.lease_started_at,
                log_lease.lease_ended_at,
                log_lease.agency_id,
                log_lease.hospital_id,
                log_lease.memo,
                log_lease.deleted_at,
                log_lease.created_at,
                log_lease.updated_at,
                log.id,
                log.action_type_id,
                log.robot_id,
                log.employee_id,
                log.memo,
                log.deleted_at,
                log.created_at,
                log.updated_at
              FROM i_robot AS i
                LEFT JOIN
                v_robot_lease_log AS log_lease
                  ON log_lease.robot_id = i.id
                LEFT JOIN
                v_robot_log AS log
                  ON log.robot_id = i.id;
        ');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        //
    }
}
