<?php

namespace Spatie\MailcoachUi\Support;

use Exception;
use Illuminate\Support\Facades\DB;
use Spatie\Valuestore\Valuestore;

class DatabaseValueStore extends ValueStore
{
    /**
     * @param array $values
     *
     * @return $this
     */
    protected function setContent(array $values)
    {
        DB::table('mailcoach_settings')->where('key', $this->fileName)->updateOrInsert([
            'key' => $this->fileName,
        ], [
            'value' => json_encode($values),
        ]);

        return $this;
    }

    /**
     * Get all values from the store.
     *
     * @return array
     */
    public function all(): array
    {
        try {
            $values = DB::table('mailcoach_settings')->where('key', $this->fileName)->select('value')->first()?->value;
        } catch (Exception) {
            return [];
        }

        return json_decode($values, true) ?? [];
    }
}
