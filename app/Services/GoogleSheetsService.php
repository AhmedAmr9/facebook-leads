<?php

namespace App\Services;

use Google_Client;
use Google_Service_Sheets;
use Google_Service_Sheets_ValueRange;
use Google_Service_Sheets_AppendValuesResponse;
use Google_Service_Sheets_UpdateValuesResponse;

class GoogleSheetsService
{
    protected $client;
    protected $service;
    protected $spreadsheetId;

    public function __construct()
    {
        // تهيئة Google Client
        $this->client = new Google_Client();
        $this->client->setApplicationName('Google Sheets API Laravel');
        $this->client->setScopes([Google_Service_Sheets::SPREADSHEETS]);
        $this->client->setAuthConfig(storage_path('app/google-service-account.json')); // تأكد من المسار الصحيح
        $this->client->setAccessType('offline');
        
        $this->service = new Google_Service_Sheets($this->client);
        $this->spreadsheetId = env('GOOGLE_SHEET_ID'); // تأكد من تعريف الـ ID في ملف .env
    }

    public function getSheetData($range)
    {
        // استرجاع البيانات من Google Sheets
        $response = $this->service->spreadsheets_values->get($this->spreadsheetId, $range);
        return $response->getValues();
    }

    public function appendDataToSheet($range, $values)
    {
        // إضافة البيانات إلى Google Sheets
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = ['valueInputOption' => 'RAW'];
        $this->service->spreadsheets_values->append($this->spreadsheetId, $range, $body, $params);
    }

    public function updateDataInSheet($range, $values)
    {
        // تحديث البيانات في Google Sheets
        $body = new Google_Service_Sheets_ValueRange([
            'values' => $values
        ]);
        $params = ['valueInputOption' => 'RAW'];
        $this->service->spreadsheets_values->update($this->spreadsheetId, $range, $body, $params);
    }
}
