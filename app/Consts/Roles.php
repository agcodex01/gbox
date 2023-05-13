<?php

namespace App\Consts;

class Roles
{
    const OFFICE_CLERK = 'OFFICE_CLERK';
    const PROD_DEV_SUPVR = 'PROD_DEV_SUPVR';
    const PROD_DEV_ASS = 'PROD_DEV_ASS';
    const PROD_TEAM_LEAD = 'PROD_TEAM_LEAD';
    const QC_INSPECTOR = 'QC_INSPECTOR';
    const ACC_STAFF = 'ACC_STAFF';
    const LOG_SUPVR = 'LOG_SUPVR';

    const ROLES_MAP = [
        self::OFFICE_CLERK => 'Office Clerk',
        self::PROD_DEV_SUPVR => 'Production Development Supvr.',
        self::PROD_DEV_ASS => 'Production Development Assistant',
        self::PROD_TEAM_LEAD => 'Production Team Lead',
        self::QC_INSPECTOR => 'QC Inspector',
        self::ACC_STAFF => 'Accountant Staff',
        self::LOG_SUPVR => 'Logistic Supvr.'
    ];


    public static function getDisplayName($const): string
    {
        return self::ROLES_MAP[$const];
    }
}
