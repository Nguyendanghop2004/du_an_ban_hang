<?php

use App\Models\Product;
use App\Models\Product_colors;
use App\Models\Product_sizes;
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
        Schema::create('product_variants', function (Blueprint $table) {
            $table->id();
            $table ->foreignIdFor(Product::class)->constrained();
            $table ->foreignIdFor(Product_sizes::class)->constrained();
            $table ->foreignIdFor(Product_colors::class)->constrained();
            $table ->unsignedBigInteger('quantity') ->default(0);
            $table ->string('image') ->nullable();
            $table ->unique(['product_id','product_sizes_id','product_colors_id'],'product_variants_unipue');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('product_variants');
    }
};
