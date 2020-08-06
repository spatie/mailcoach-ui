<?php

namespace Spatie\MailcoachUi\Http\App\Queries;

use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\MailcoachUi\Models\User;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class UsersQuery extends QueryBuilder
{
    public function __construct()
    {
        parent::__construct(User::query());

        $this
            ->defaultSort('email')
            ->allowedSorts('email', 'name')
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('email', 'name'))
            );
    }
}
