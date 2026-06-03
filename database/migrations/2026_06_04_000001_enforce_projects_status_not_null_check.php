<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    private array $statuses = [
        'open',
        'waiting_payment',
        'payment_verified',
        'in_progress',
        'submitted',
        'completed',
        'cancelled',
    ];

    public function up(): void
    {
        $this->replaceStatusConstraint($this->statuses);
    }

    public function down(): void
    {
        $this->replaceStatusConstraint($this->statuses);
    }

    private function replaceStatusConstraint(array $statuses): void
    {
        $constraints = DB::select(
            "select uc.constraint_name
             from user_constraints uc
             join user_cons_columns ucc
               on uc.constraint_name = ucc.constraint_name
              and uc.table_name = ucc.table_name
             where uc.table_name = 'PROJECTS'
               and uc.constraint_type = 'C'
               and ucc.column_name = 'STATUS'"
        );

        foreach ($constraints as $constraint) {
            $name = $constraint->constraint_name ?? $constraint->CONSTRAINT_NAME ?? null;
            if ($name) {
                DB::statement('alter table "PROJECTS" drop constraint "' . $name . '"');
            }
        }

        $allowed = collect($statuses)
            ->map(fn ($status) => "'" . str_replace("'", "''", $status) . "'")
            ->implode(', ');

        DB::statement(
            'alter table "PROJECTS" add constraint "PROJECTS_STATUS_CHECK" check ("STATUS" is not null and "STATUS" in (' . $allowed . '))'
        );
    }
};
