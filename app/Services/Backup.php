<?php

namespace App\Services;

use Illuminate\Support\Facades\Date;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Symfony\Component\Finder\SplFileInfo;

class Backup
{
    protected $file;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function name()
    {
        return $this->file->getFilename();
    }

    public function date()
    {
        $date = Date::createFromTimestamp($this->file->getCTime());
        return "{$date->format(DF)} a las {$date->format(TF)}";
    }

    public function size()
    {
        return $this->sizeOnMB($this->file->getSize());
    }

    public function exists()
    {
        return $this->all()->count() > 0;
    }

    public function file()
    {
        return $this->file;
    }

    public static function all() {
        return collect(File::files(storage_path('app/Vinculacion-Social')))
            ->map(function ($file) {
                return new self($file);
            })
            ->reverse()
            ->take(5);
    }

    public static function find($filename) {
        return static::all()->filter(function ($file) use ($filename) {
            return $file->name === $filename;
        })->first();
    }

    public function delete()
    {
        $path = $this->file->getRealPath();
        File::delete($path);
    }

    public function __get($name)
    {
        $props = collect(['date', 'size', 'hash', 'name', 'file']);

        if (!$props->contains($name)) return null;

        return $this->{$name}();
    }

    protected function sizeOnMB($bytes, $decimals = 2)
    {
        $sz = 'BKMGTP';
        $factor = floor((strlen($bytes) - 1) / 3);
        return sprintf("%.{$decimals}f", $bytes / pow(1024, $factor)) . @$sz[$factor];
    }
}