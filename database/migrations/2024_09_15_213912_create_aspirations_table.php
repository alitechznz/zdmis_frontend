    <?php

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
            Schema::create('aspirations', function (Blueprint $table) {
                $table->id();
                $table->foreignId('created_by');
                $table->foreignId('priority_area_id');
                $table->foreignId('plan_id')->nullable();
                $table->text('name');
                $table->string('type')->nullable();
                $table->enum('status', ['active', 'inactive'])->default('active');
                $table->timestamps();
            });
        }

        /**
         * Reverse the migrations.
         */
        public function down(): void
        {
            Schema::dropIfExists('aspirations');
        }
    };
