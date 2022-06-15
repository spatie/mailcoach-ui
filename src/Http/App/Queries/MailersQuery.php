<?php

namespace Spatie\MailcoachUi\Http\App\Queries;

use Illuminate\Http\Request;
use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\MailcoachUi\Models\Mailer;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MailersQuery extends QueryBuilder
{
    public function __construct(?Request $request = null)
    {
        parent::__construct(Mailer::query(), $request);

        $this
            ->defaultSort('name')
            ->allowedSorts('name', 'transport')
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('name', 'transport'))
            );
    }
}
