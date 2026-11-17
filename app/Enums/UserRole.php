<?php

namespace App\Enums;

enum UserRole: string
{
    case JOB_SEEKER = 'job_seeker';
    case EMPLOYER = 'employer';

    /**
     * Get all valid role values as an array of strings.
     *
     * @return list<string>
     */
    public static function values(): array
    {
        return array_column(self::cases(), 'value');
    }

    /**
     * Resolve a role strictly from an allowed registration type.
     * Rejects any unrecognized or privileged roles (e.g. admin, superadmin).
     */
    public static function fromRegistrationType(?string $type): ?self
    {
        if ($type === null) {
            return null;
        }

        $normalized = strtolower(trim($type));

        return match ($normalized) {
            'job_seeker', 'jobseeker', 'pencari_kerja', 'pencari kerja', 'pencari-kerja' => self::JOB_SEEKER,
            'employer', 'perusahaan', 'pemberi_kerja', 'pemberi kerja', 'pemberi-kerja' => self::EMPLOYER,
            default => null,
        };
    }

    /**
     * Return a human-readable label for the role in Indonesian.
     */
    public function label(): string
    {
        return match ($this) {
            self::JOB_SEEKER => 'Pencari Kerja',
            self::EMPLOYER => 'Perusahaan',
        };
    }
}
