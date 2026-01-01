<?php

namespace App\Jobs;

use App\Helpers\BillHelpers;
use App\Models\Bill;
use App\Models\InvoiceTemplate;
use App\Models\Status;
use DateTime;
use Illuminate\Contracts\Queue\ShouldBeEncrypted;
use Illuminate\Contracts\Queue\ShouldBeUniqueUntilProcessing;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Bus\Queueable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Foundation\Bus\Dispatchable;



use function Illuminate\Log\log;

class CreateBills implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }
    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $today = date_format(new DateTime(), 'j');
        $this_month = (int) date_format(new DateTime(), 'n');
        $this_year = (int) date_format(new DateTime(), 'Y');
        $invoice_templates = InvoiceTemplate::all();
        if ($today == 1) {
            foreach ($invoice_templates as $invoice_template) {
                if (!BillHelpers::bill_generated($invoice_template, $this_month, $this_year)) {
                    $day = $invoice_template->due_day_id;
                    Bill::create([
                        'invoice_template_id' => $invoice_template->id,
                        'status_id' => Status::where('name', 'Pending')->first()->id,
                        'due_date' => date_create($this_year . '-' . $this_month . '-' . $day),
                    ]);
                }
            }
        }
    }
}
