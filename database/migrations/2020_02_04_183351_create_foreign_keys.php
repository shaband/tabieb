<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Eloquent\Model;

class CreateForeignKeys extends Migration {

	public function up()
	{
		Schema::table('patients', function(Blueprint $table) {
			$table->foreign('social_security_id')->references('id')->on('social_securities')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->foreign('area_id')->references('id')->on('areas')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->foreign('block_id')->references('id')->on('blocks')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('doctors', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('areas', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('blocks', function(Blueprint $table) {
			$table->foreign('area_id')->references('id')->on('areas')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->foreign('district_id')->references('id')->on('districts')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->foreign('area_id')->references('id')->on('areas')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->foreign('block_id')->references('id')->on('blocks')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('pharmacy_reps', function(Blueprint $table) {
			$table->foreign('pharmacy_id')->references('id')->on('pharmacies')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('patient_answers', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('patient_answers', function(Blueprint $table) {
			$table->foreign('question_id')->references('id')->on('patient_questions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('doctor_category', function(Blueprint $table) {
			$table->foreign('category_id')->references('id')->on('categories')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('doctor_category', function(Blueprint $table) {
			$table->foreign('doctor_id')->references('id')->on('doctors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('reservation_id')->references('id')->on('reservations')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('doctor_id')->references('id')->on('doctors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->foreign('doctor_id')->references('id')->on('doctors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->foreign('reservation_id')->references('id')->on('reservations')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->foreign('chat_id')->references('id')->on('chats')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('schedules', function(Blueprint $table) {
			$table->foreign('doctor_id')->references('id')->on('doctors')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->foreign('doctor_id')->references('id')->on('doctors')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->foreign('schedule_id')->references('id')->on('schedules')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->foreign('reservation_id')->references('id')->on('reservations')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->foreign('phramacy_id')->references('id')->on('pharmacies')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->foreign('phramacy_rep_id')->references('id')->on('pharmacy_reps')
						->onDelete('set null')
						->onUpdate('cascade');
		});
		// Schema::table('prescriptions', function(Blueprint $table) {
		// 	$table->foreign('doctor_id')->references('id')->on('doctors')
		// 				->onDelete('set null')
		// 				->onUpdate('cascade');
		// });
		Schema::table('prescription_items', function(Blueprint $table) {
			$table->foreign('prescription_id')->references('id')->on('prescriptions')
						->onDelete('cascade')
						->onUpdate('cascade');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->foreign('reservation_id')->references('id')->on('reservations')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->foreign('patient_id')->references('id')->on('patients')
						->onDelete('restrict')
						->onUpdate('cascade');
		});
	}

	public function down()
	{
		Schema::table('patients', function(Blueprint $table) {
			$table->dropForeign('patients_social_security_id_foreign');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->dropForeign('patients_district_id_foreign');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->dropForeign('patients_area_id_foreign');
		});
		Schema::table('patients', function(Blueprint $table) {
			$table->dropForeign('patients_block_id_foreign');
		});
		Schema::table('doctors', function(Blueprint $table) {
			$table->dropForeign('doctors_category_id_foreign');
		});
		Schema::table('categories', function(Blueprint $table) {
			$table->dropForeign('categories_category_id_foreign');
		});
		Schema::table('areas', function(Blueprint $table) {
			$table->dropForeign('areas_district_id_foreign');
		});
		Schema::table('blocks', function(Blueprint $table) {
			$table->dropForeign('blocks_area_id_foreign');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->dropForeign('pharmacies_district_id_foreign');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->dropForeign('pharmacies_area_id_foreign');
		});
		Schema::table('pharmacies', function(Blueprint $table) {
			$table->dropForeign('pharmacies_block_id_foreign');
		});
		Schema::table('pharmacy_reps', function(Blueprint $table) {
			$table->dropForeign('pharmacy_reps_pharmacy_id_foreign');
		});
		Schema::table('patient_answers', function(Blueprint $table) {
			$table->dropForeign('patient_answers_patient_id_foreign');
		});
		Schema::table('patient_answers', function(Blueprint $table) {
			$table->dropForeign('patient_answers_question_id_foreign');
		});
		Schema::table('doctor_category', function(Blueprint $table) {
			$table->dropForeign('doctor_category_category_id_foreign');
		});
		Schema::table('doctor_category', function(Blueprint $table) {
			$table->dropForeign('doctor_category_doctor_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_reservation_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_doctor_id_foreign');
		});
		Schema::table('ratings', function(Blueprint $table) {
			$table->dropForeign('ratings_patient_id_foreign');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_doctor_id_foreign');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_patient_id_foreign');
		});
		Schema::table('chats', function(Blueprint $table) {
			$table->dropForeign('chats_reservation_id_foreign');
		});
		Schema::table('messages', function(Blueprint $table) {
			$table->dropForeign('messages_chat_id_foreign');
		});
		Schema::table('schedules', function(Blueprint $table) {
			$table->dropForeign('schedules_doctor_id_foreign');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->dropForeign('reservations_doctor_id_foreign');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->dropForeign('reservations_patient_id_foreign');
		});
		Schema::table('reservations', function(Blueprint $table) {
			$table->dropForeign('reservations_schedule_id_foreign');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->dropForeign('prescriptions_reservation_id_foreign');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->dropForeign('prescriptions_phramacy_id_foreign');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->dropForeign('prescriptions_patient_id_foreign');
		});
		Schema::table('prescriptions', function(Blueprint $table) {
			$table->dropForeign('prescriptions_pharmacy_rep_id_foreign');
		});
		Schema::table('prescription_items', function(Blueprint $table) {
			$table->dropForeign('prescription_items_prescription_id_foreign');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->dropForeign('invoices_reservation_id_foreign');
		});
		Schema::table('invoices', function(Blueprint $table) {
			$table->dropForeign('invoices_patient_id_foreign');
		});
	}
}
