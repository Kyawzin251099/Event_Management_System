<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        DB::statement('
        CREATE VIEW vw_generateqr AS
        SELECT
        ad_hocs.id as ad_hoc_id,
        ad_hocs.event_id as event_id,
        ad_hocs.first_name as first_name,
        ad_hocs.middle_name as middle_name,
        ad_hocs.last_name as last_name,
        ad_hocs.phone_no as phone_no,
        ad_hocs.email as email,
        qr_tickets.qr_code as qr_code,
        events.event_name as event_name
        FROM ((ad_hocs
        INNER JOIN qr_tickets ON qr_tickets.ad_hoc_id = ad_hocs.id)
        INNER JOIN events ON events.id = ad_hocs.event_id);
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_generateqr');
    }
};
