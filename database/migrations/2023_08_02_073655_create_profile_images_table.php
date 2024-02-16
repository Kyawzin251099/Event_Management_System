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
        CREATE VIEW vw_profileimage AS
        SELECT
        platform_users.id as platform_users_id,
        images.link_id as link_id,
        images.genre as genre,
        images.upload_url as upload_url
        FROM images
        INNER JOIN platform_users ON platform_users.id = images.link_id 
        WHERE images.genre = 1;
        ');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('DROP VIEW IF EXISTS vw_profileimage');
    }
};
