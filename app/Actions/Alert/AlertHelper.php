<?php

namespace App\Actions\Alert;

use App\Constants\AlertEntity;
use RealRashid\SweetAlert\Facades\Alert;

class AlertHelper
{
    private static array $entities = [
        AlertEntity::ALUMNI => 'Alumni',
        AlertEntity::WORK_HISTORY => 'Riwayat pekerjaan',
        AlertEntity::SCHOOL => 'Sekolah',
        AlertEntity::COMPANY => 'Perusahaan',
        AlertEntity::USER => 'Pengguna',
        AlertEntity::ROLE => 'Peran',
    ];

    public static function created(string $entity): void
    {
        Alert::toast(__('messages.alerts.created_successfully', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'success');
    }

    public static function updated(string $entity): void
    {
        Alert::toast(__('messages.alerts.updated_successfully', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'success');
    }

    public static function deleted(string $entity): void
    {
        Alert::toast(__('messages.alerts.deleted_successfully', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'success');
    }

    public static function creationFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.creation_failed', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'error');
    }

    public static function updationFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.updation_failed', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'error');
    }

    public static function deletionFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.deletion_failed', [
            'entity' => self::$entities[$entity] ?? $entity
        ]), 'error');
    }
}
