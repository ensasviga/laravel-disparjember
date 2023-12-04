<?php

use App\Models\setting;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->id();
            $table->string('key');
            $table->string('label');
            $table->string('value')->nullable();
            $table->string('type');

            $table->timestamps();
        });

        setting::create([
            'key'=> '_hastag',
            'label'=> 'Judul Situs',
            'value'=> '#WESWAYAHEBENAHIJEMBER',
            'type'=> 'text',
        ]);

        setting::create([
            'key'=> '_location',
            'label'=> 'Alamat Kantor',
            'value'=> 'Jember, Jawa Timur, Indonesia',
            'type'=> 'text',
        ]);

        setting::create([
            'key'=> '_instagram',
            'label'=> 'Instagram',
            'value'=> 'https://www.instagram.com/vigaensas/',
            'type'=> 'text',
        ]);

        setting::create([
            'key'=> '_site_desc',
            'label'=> 'Site Desc',
            'value'=> 'Wayahewayahe',
            'type'=> 'text',
        ]);
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('settings');
    }
};
