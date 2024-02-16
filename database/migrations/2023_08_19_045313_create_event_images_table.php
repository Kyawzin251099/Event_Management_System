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
        CREATE VIEW vw_eventimage AS
        SELECT
        events.id as event_id,
        images.link_id as link_id,
        images.genre as genre,
        images.upload_url as upload_url
        FROM images
        INNER JOIN events ON events.id = images.link_id
        WHERE images.genre = 3;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_eventimage');
    }
};
