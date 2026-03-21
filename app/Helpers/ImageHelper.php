<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;

class ImageHelper
{
    /**
     * Create/Upload new image.
     *
     * @param $file
     * @param string $path
     * @return string|null
     */
    public static function create($file, string $path): ?string
    {
        if ($file) {
            $fileName = time() . '_' . Str::random(10) . '.' . $file->getClientOriginalExtension();
            return $file->storeAs($path, $fileName, 'public');
        }
        return null;
    }

    /**
     * Update existing image.
     *
     * @param $file
     * @param string $path
     * @param string|null $old_file
     * @return string|null
     */
    public static function update($file, string $path, string $old_file = null): ?string
    {
        if ($file) {
            // Delete old file
            self::delete($old_file);
            
            // Upload new file
            return self::create($file, $path);
        }
        return $old_file;
    }

    /**
     * Delete image.
     *
     * @param string|null $file
     * @return void
     */
    public static function delete(string $file = null): void
    {
        if ($file && Storage::disk('public')->exists($file)) {
            Storage::disk('public')->delete($file);
        }
    }
}
