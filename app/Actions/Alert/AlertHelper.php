<?php

namespace App\Actions\Alert;

use App\Constants\AlertEntity;
use RealRashid\SweetAlert\Facades\Alert;

class AlertHelper
{
    private static function getEntityName(string $entity): string
    {
        $entities = [
            AlertEntity::ALUMNI => 'messages.alerts.entities.alumni',
            AlertEntity::WORK_HISTORY => 'messages.alerts.entities.work_history',
            AlertEntity::SCHOOL => 'messages.alerts.entities.school',
            AlertEntity::COMPANY => 'messages.alerts.entities.company',
            AlertEntity::USER => 'messages.alerts.entities.user',
            AlertEntity::ROLE => 'messages.alerts.entities.role',
        ];

        return __($entities[$entity] ?? $entity);
    }

    public static function created(string $entity): void
    {
        Alert::toast(__('messages.alerts.created_successfully', [
            'entity' => self::getEntityName($entity)
        ]), 'success');
    }

    public static function updated(string $entity): void
    {
        Alert::toast(__('messages.alerts.updated_successfully', [
            'entity' => self::getEntityName($entity)
        ]), 'success');
    }

    public static function deleted(string $entity): void
    {
        Alert::toast(__('messages.alerts.deleted_successfully', [
            'entity' => self::getEntityName($entity)
        ]), 'success');
    }

    public static function creationFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.creation_failed', [
            'entity' => self::getEntityName($entity)
        ]), 'error');
    }

    public static function updationFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.updation_failed', [
            'entity' => self::getEntityName($entity)
        ]), 'error');
    }

    public static function deletionFailed(string $entity): void
    {
        Alert::toast(__('messages.alerts.deletion_failed', [
            'entity' => self::getEntityName($entity)
        ]), 'error');
    }
}
