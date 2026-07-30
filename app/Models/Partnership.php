<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Partnership extends Model
{
    protected $fillable = [
        'institution_name',
        'pic_name',
        'email',
        'summary',
        'proposal_file',
        'status',
    ];

    // proposal_file is stored as an absolute Cloudinary URL. Any remaining rows with a
    // relative 'partnership_files/...' path are legacy submissions from local storage.
    public function getProposalFileUrlAttribute(): ?string
    {
        if (! $this->proposal_file) {
            return null;
        }

        if (str_starts_with($this->proposal_file, 'http://') || str_starts_with($this->proposal_file, 'https://')) {
            return $this->proposal_file;
        }

        return asset('storage/' . $this->proposal_file);
    }
}



