<?php

use Illuminate\Database\Migrations\Migration;

class ChangingDatabaseTablesNames extends Migration {

	/**
	 * Run the migrations.
	 *
	 * @return void
	 */
	public function up()
	{
		Schema::rename('directfixrequests', 'direct_fix_requests');
		Schema::rename('fixoffers', 'fix_offers');
		Schema::rename('fixrequests', 'fix_requests');
		Schema::rename('promotionpages', 'promotion_pages');
	}

	/**
	 * Reverse the migrations.
	 *
	 * @return void
	 */
	public function down()
	{
		Schema::rename('direct_fix_requests', 'directfixrequests');
		Schema::rename('fix_offers', 'fixoffers');
		Schema::rename('fix_requests', 'fixrequests');
		Schema::rename('promotion_pages', 'promotionpages');
	}

}