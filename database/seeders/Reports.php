<?php

namespace Database\Seeders;

use App\Abstracts\Model;
use App\Jobs\Common\CreateReport;
use App\Traits\Jobs;
use Illuminate\Database\Seeder;

class Reports extends Seeder
{
    use Jobs;

    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Model::unguard();

        $this->create();

        Model::reguard();
    }

    private function create()
    {
        $company_id = $this->command->argument('company');

        $rows = [
            [
                'company_id' => $company_id,
                'class' => 'App\Reports\IncomeSummary',
                'name' => trans('reports.income_summary'),
                'description' => trans('demo.reports.income'),
                'settings' => ['group' => 'category', 'period' => 'monthly', 'basis' => 'accrual'],
            ],
            [
                'company_id' => $company_id,
                'class' => 'App\Reports\ExpenseSummary',
                'name' => trans('reports.expense_summary'),
                'description' => trans('demo.reports.expense'),
                'settings' => ['group' => 'category', 'period' => 'monthly', 'basis' => 'accrual'],
            ],
            [
                'company_id' => $company_id,
                'class' => 'App\Reports\IncomeExpenseSummary',
                'name' => trans('reports.income_expense_summary'),
                'description' => trans('demo.reports.income_expense'),
                'settings' => ['group' => 'category', 'period' => 'monthly', 'basis' => 'accrual'],
            ],
            [
                'company_id' => $company_id,
                'class' => 'App\Reports\ProfitLoss',
                'name' => trans('reports.profit_loss'),
                'description' => trans('demo.reports.profit_loss'),
                'settings' => ['group' => 'category', 'period' => 'quarterly', 'basis' => 'accrual'],
            ],
            [
                'company_id' => $company_id,
                'class' => 'App\Reports\TaxSummary',
                'name' => trans('reports.tax_summary'),
                'description' => trans('demo.reports.tax'),
                'settings' => ['period' => 'quarterly', 'basis' => 'accrual'],
            ],
        ];

        foreach ($rows as $row) {
            $row['created_from'] = 'core::seed';

            $this->dispatch(new CreateReport($row));
        }
    }
}
