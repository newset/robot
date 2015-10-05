<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class VMark extends Migration
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
          v_mark
          (
          id,
          cust_id,
          `status`,
          sold,
          replacement_id,
          doctor_id,
          agency_id,
          hospital_id,
          robot_id,
          surgery_type,
          surgery_at,
          patient_id,
          sold_at,
          used_at,
          damaged_at,
          archive_at,
          memo,
          deleted_at,
          created_at,
          updated_at,
          agency_name,
          hospital_name,
          doctor_name,
          robot_cust_id
          )
          AS
          SELECT
            i.id,
            i.cust_id,
            i.status,
            i.sold,
            i.replacement_id,
            i.doctor_id,
            i.agency_id,
            i.hospital_id,
            i.robot_id,
            i.surgery_type,
            i.surgery_at,
            i.patient_id,
            i.sold_at,
            i.used_at,
            i.damaged_at,
            i.archive_at,
            i.memo,
            i.deleted_at,
            i.created_at,
            i.updated_at,
            a.name AS agency_name,
            h.name AS hospital_name,
            d.name AS doctor_name,
            r.cust_id AS robot_cust_id
          FROM i_mark AS i
            LEFT JOIN i_hospital AS h
              ON i.hospital_id = h.id
            LEFT JOIN i_agency AS a
              ON i.agency_id = a.id
            LEFT JOIN i_doctor AS d
              ON i.doctor_id = d.id
            LEFT JOIN i_robot AS r
              ON i.robot_id = r.id
              ;
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
