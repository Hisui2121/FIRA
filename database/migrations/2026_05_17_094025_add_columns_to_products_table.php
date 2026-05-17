<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->string('name')->after('id');
            $table->string('sku')->unique()->after('name');
            $table->decimal('price', 10, 2)->after('sku');
            $table->foreignId('category_id')->nullable()->constrained()->after('price');
            $table->foreignId('supplier_id')->nullable()->constrained()->after('category_id');
        });
    }

    public function down(): void
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropForeign(['category_id']);
            $table->dropForeign(['supplier_id']);
            $table->dropColumn(['name', 'sku', 'price', 'category_id', 'supplier_id']);
        });
    }
};