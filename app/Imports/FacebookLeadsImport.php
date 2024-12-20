<?php

namespace App\Imports;

use App\Models\FacebookLead;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Illuminate\Support\Facades\Auth;

class FacebookLeadsImport implements ToModel, WithHeadingRow
{
    protected $userName;

    // استلام اسم المستخدم عبر الـ constructor
    public function __construct($userName)
    {
        $this->userName = $userName;
    }

    /**
     * تحويل البيانات من صف إلى Model.
     *
     * @param array $row
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        // إذا كانت قيمة ad_set_name فارغة، تجاهل السطر
        if (empty($row['ad_set_name'])) {
            return null; // تجاهل السطر وعدم رفعه
        }

        // // تحقق إذا كان السطر كاملًا مكررًا في قاعدة البيانات
        // $existingLead = FacebookLead::where('campaign_name', $row['campaign_name'] ?? null)
        //     ->where('ad_set_name', $row['ad_set_name'] ?? null)
        //     ->where('delivery_status', $row['delivery_status'] ?? null)
        //     ->where('delivery_level', $row['delivery_level'] ?? null)
        //     ->where('reach', $row['reach'] ?? null)
        //     ->where('impressions', $row['impressions'] ?? null)
        //     ->where('frequency', $row['frequency'] ?? null)
        //     ->where('attribution_setting', $row['attribution_setting'] ?? null)
        //     ->where('result_type', $row['result_type'] ?? null)
        //     ->where('results', $row['results'] ?? null)
        //     ->where('amount_spent', $row['amount_spent'] ?? null)
        //     ->where('cost_per_result', $row['cost_per_result'] ?? null)
        //     ->where('starts', $row['starts'] ?? null)
        //     ->where('ends', $row['ends'] ?? null)
        //     ->where('reporting_starts', $row['reporting_starts'] ?? null)
        //     ->where('reporting_ends', $row['reporting_ends'] ?? null)
        //     ->first();

        // // إذا وجد السطر بنفس البيانات، تجاهله
        // if ($existingLead) {
        //     return null; // تجاهل السطر إذا كان مكررًا
        // }

        // استخدام اسم المستخدم الذي تم تمريره
        $userName = $this->userName ?: 'Guest';  // استخدم اسم المستخدم المرسل أو 'Guest' إذا لم يكن مسجلاً

        // إذا السطر غير مكرر، احفظه في قاعدة البيانات
        return new FacebookLead([
            'campaign_name'     => $row['campaign_name'] ?? null,
            'ad_set_name'       => $row['ad_set_name'] ?? null,
            'delivery_status'   => $row['delivery_status'] ?? null,
            'delivery_level'    => $row['delivery_level'] ?? null,
            'reach'             => $row['reach'] ?? null,
            'impressions'       => $row['impressions'] ?? null,
            'frequency'         => $row['frequency'] ?? null,
            'attribution_setting'=> $row['attribution_setting'] ?? null,
            'result_type'       => $row['result_type'] ?? null,
            'results'           => $row['results'] ?? null,
            'amount_spent'      => $row['amount_spent'] ?? null,
            'cost_per_result'   => $row['cost_per_result'] ?? null,
            'starts'            => $row['starts'] ?? null,
            'ends'              => $row['ends'] ?? null,
            'reporting_starts'  => $row['reporting_starts'] ?? null,
            'reporting_ends'    => $row['reporting_ends'] ?? null,
            'uploaded_by'       => $userName,  // إضافة اسم المستخدم إلى العمود
        ]);
    }

    /**
     * تحديد السطر الذي يحتوي على الهيدرز في ملف Excel.
     */
    public function headingRow(): int
    {
        return 3; // تحديد أن الهيدرز في السطر الثالث، وبالتالي سيبدأ أخذ البيانات من السطر الرابع
    }

    // مساعد لتحويل التاريخ
    protected function parseDate($date)
    {
        try {
            return $date ? \Carbon\Carbon::parse($date) : null;
        } catch (\Exception $e) {
            return null; // العودة بـ null في حالة وجود خطأ في التحويل
        }
    }
}
