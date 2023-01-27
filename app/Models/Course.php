<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Shared\QueryScopes;
use Illuminate\Support\Str;

class Course extends Model
{
    use HasFactory, QueryScopes;

    /**
     * The attributes that are not mass assignable.
     *
     * @var array<int, string>
     */
    protected $guarded = ['id'];

    protected $casts = [
        'start_ins' => 'date',
        'end_ins' => 'date',
        'start_course' => 'date',
        'end_course' => 'date',
        'start_hour' => 'datetime',
        'end_hour' => 'datetime',
    ];

    protected $withCount = ['students'];

    protected static $searchColumn = 'name';

    public function instructor()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class, 'enrollments')
            ->wherePivotNull('deleted_at');
    }

    public function enrollments()
    {
        return $this->hasMany(Enrollment::class);
    }

    public function area() 
    {
        return $this->belongsTo(Area::class);
    }

    public function scopePhase($query, $phase)
    {
        $now = now()->format(DV);

        switch ($phase) {
            case 'Pre-inscripciones':
                $query->where('start_ins', '>', $now);
                break;
            case 'Inscripciones':
                $query->where('start_ins', '<', $now)
                    ->where('end_ins', '>', $now);
                break;
            case 'Pre-curso':
                $query->where('end_ins', '<', $now)
                    ->where('start_course', '>', $now);
                break;
            case 'En curso':
                $query->where('start_course', '<', $now)
                    ->where('end_course', '>', $now);
                break;
            case 'Finalizado':
                $query->where('end_course', '<', $now);
                break;
        }   
    }
    
    public function scopeAvailables($query)
    {
        // TODO -> debe haber mejores maneras de hacer estos tres scopeQuery, y evitar tanta repetición de codigo.
        $courses = self::phase('Inscripciones')
            ->get();
        
        $ids = $courses
            ->filter(fn($course) => $course->students_count < $course->student_limit)
            ->ids();
        
        return $query->whereIn('id', $ids);
    }
    
    public function scopeNotBoughtBy($query, $user)
    {
        $ids = $user
            ->enrolledCourses
            ->ids();

        $query->whereNotIn('id', $ids);
    }

    public function scopeBoughtBy($query, $user)
    {
        $ids = $user
            ->enrolledCourses
            ->ids();
        
        $query->whereIn('id', $ids);
    }

    public static function getOptions()
    {
        $areas = self::all(['id', 'name']);

        $options = $areas->mapWithKeys(fn($area) => [$area->id => $area->name])
            ->sortKeys()
            ->all();

        return $options;
    }

     /** --------------- Accesors and Mutators --------------- */

    public function getExcerptAttribute()
    {
        return Str::words($this->description, 8);
    }

    public function getStudentDiffAttribute()
    {
        return "{$this->students_count} / {$this->student_limit}";
    }

    public function getDaysTextAttribute()
    {
        return collect(explode(',', $this->days))
            ->join(', ', ' y ');
    }

    public function getDaysArrAttribute()
    {
        return collect(explode(',', $this->days));
    }

    public function getPhaseAttribute()
    {
        $now = now()->getTimestamp();
        $startIns = $this->start_ins->getTimestamp();
        $endIns = $this->end_ins->getTimestamp();
        $startCourse = $this->start_course->getTimestamp();
        $endCourse = $this->end_course->getTimestamp();

        return match(true) {
            $now < $startIns => 'Pre-inscripciones',
            $now < $endIns => 'Inscripciones',
            $now < $startCourse => 'Pre-curso',
            $now < $endCourse => 'En curso',
            default => 'Finalizado',
        };
    }

    public function getDurationHoursAttribute()
    {
        return "{$this->duration} hrs.";
    }

    public function getDateAttribute()
    {
        return "{$this->start_course->format(DF)} al {$this->end_course->format(DF)}";
    }
    
    public function getInsDateAttribute()
    {
        return "{$this->start_ins->format(DF)} al {$this->end_ins->format(DF)}";
    }
    
    public function getHoursAttribute()
    {
        return "{$this->start_hour->format(TF)} a {$this->end_hour->format(TF)}";
    }

    public function getTotalAmountAttribute()
    {
        return "{$this->total_price}$";
    }

    public function getReservAmountAttribute()
    {
        return "{$this->reserv_price}$";
    }

    public function setDaysAttribute($daysArray)
    {
        $this->attributes['days'] = collect($daysArray)
            ->join(',');
    }

    public function hasReserv()
    {
        return (bool) $this->reserv_price;
    }
}
