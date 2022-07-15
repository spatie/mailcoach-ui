<?php

namespace Spatie\MailcoachUi\Http\App\Queries;

use Illuminate\Http\Request;
use Spatie\Mailcoach\Http\App\Queries\Filters\FuzzyFilter;
use Spatie\MailcoachUi\Models\UsesMailcoachUiModels;
use Spatie\QueryBuilder\AllowedFilter;
use Spatie\QueryBuilder\QueryBuilder;

class MailersQuery extends QueryBuilder
{
    use UsesMailcoachUiModels;

    public function __construct(?Request $request = null)
    {
        parent::__construct(self::getMailerClass()::query(), $request);

        $this
            ->defaultSort('name')
            ->allowedSorts('name', 'transport', 'ready_for_use', 'default')
            ->allowedFilters(
                AllowedFilter::custom('search', new FuzzyFilter('name', 'transport'))
            );
    }
}
