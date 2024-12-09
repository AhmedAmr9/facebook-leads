<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddColumnsToFacebookLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('facebook_leads', function (Blueprint $table) {
            $table->string('campaign_name')->nullable();
            $table->string('ad_set_name')->nullable();
            $table->string('delivery_status')->nullable();
            $table->string('delivery_level')->nullable();
            $table->integer('reach')->nullable();
            $table->integer('impressions')->nullable();
            $table->float('frequency')->nullable();
            $table->string('attribution_setting')->nullable();
            $table->string('result_type')->nullable();
            $table->integer('results')->nullable();
            $table->decimal('amount_spent', 8, 2)->nullable();
            $table->decimal('cost_per_result', 8, 2)->nullable();
            $table->timestamp('starts')->nullable();
            $table->timestamp('ends')->nullable();
            $table->timestamp('reporting_starts')->nullable();
            $table->timestamp('reporting_ends')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('facebook_leads', function (Blueprint $table) {
            $table->dropColumn([
                'campaign_name', 'ad_set_name', 'delivery_status', 
                'delivery_level', 'reach', 'impressions', 'frequency', 
                'attribution_setting', 'result_type', 'results', 
                'amount_spent', 'cost_per_result', 'starts', 'ends', 
                'reporting_starts', 'reporting_ends'
            ]);
        });
    }
}
