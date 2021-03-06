<?php

namespace App\Models;

use App\Models\Comment;
use App\Models\CandidateComment;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

/**
 * App\Models\Candidate
 *
 * @property int $id
 * @property string $name
 * @property string $surnname
 * @property string $gender
 * @property string|null $phone
 * @property string $email
 * @property string $application_date
 * @property string $educationInstitution
 * @property string $city
 * @property string $status
 * @property string $course
 * @property string $academy
 * @property string $comment
 * @property string $CV
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Database\Factories\CandidateFactory factory(...$parameters)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate query()
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereAcademy($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereApplicationDate($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCV($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereComment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCourse($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereEducationInstitution($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereGender($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate wherePhone($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereSurnname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereUpdatedAt($value)
 * @mixin \Eloquent
 * @property int $education_institution_id
 * @property int $academy_id
 * @property-read \Illuminate\Database\Eloquent\Collection|CandidateComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|Position[] $positions
 * @property-read int|null $positions_count
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereAcademyId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereEducationInstitutionId($value)
 * @property string $can_manage_data
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate whereCanManageData($value)
 * @method static \Illuminate\Database\Eloquent\Builder|Candidate search($search)
 */
class Candidate extends Model
{
    use HasFactory;

    protected $with = ['positions','comments','educationInstitution','academy'];

    protected $hidden = ['created_at','updated_at','education_institution_id','academy_id'];

    public const COURSES = [
        'first stage 1',
        'first stage 2',
        'first stage 3',
        'first stage 4',
        'second stage 1',
        'second stage 2',
        'graduated bachelor',
        'graduated masters',
        'not studying'
    ];

    public const GENDERS =
    [
        'male',
        'female',
    ];

    public const STATUSES =
    [
        'candidate',
        'called for interview',
        'interviewed',
        'accepted for internship',
        'employed',
        'not accepted for internship',
        'not employed',
        'declined',
        'other'
    ];

    public function scopeSearch($query,$search)
    {
        return $query->where('name', 'like', "%$search%")
        ->orwhere('surnname', 'like', "%$search%")
        ->orwhere('email', 'like', "%$search%")
        ->orwhere('phone', 'like', "%$search%");
    }

    public function positions()
    {
        return $this->belongsToMany(Position::class, 'candidates_positions');
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function educationInstitution()
    {
        return $this->belongsTo(EducationInstitution::class);
    }

    public function academy()
    {
        return $this->belongsTo(Academy::class);
    }
}
