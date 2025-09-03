<?php

namespace App\Http\Requests;

use App\Models\Table;
use App\Rules\DateBetween;
use Illuminate\Foundation\Http\FormRequest;
use Illuminate\Support\Facades\App;

class ReservationStoreRequest extends FormRequest
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize(): bool
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array<string, mixed>
     */
    public function rules(): array
    {
        $isAdmin = $this->user() && $this->user()->isAdmin();

        return [
            'first_name' => ['required', 'string'],
            'last_name' => ['required', 'string'],
            'email' => App::environment('production')
                ? 'required|email:rfc,dns'
                : 'required|email:rfc',
            'mobile_number' => ['required', 'string', 'regex:/^([0-9\s\-\+\(\)]*)$/'],
            'date' => ['required', 'date', new DateBetween],
            'total_guests' => ['required', 'numeric', 'min:1', !$isAdmin ? 'max:'. Table::query()->max('capacity') : ''],
            'note' => ['nullable', 'string'],
            'time_slot' => $isAdmin
                ? ['required', 'array'] // must be an array
                : ['required', 'numeric', 'exists:time_slots,id'],
            'time_slot.*'  => $isAdmin ? ['numeric', 'exists:time_slots,id'] : [],
        ];
    }

    public function validatedWithTimeSlot(): array
    {
        $validated = $this->validated();
        $validatedTimeSlot = $validated['time_slot'];
        unset($validated['time_slot']);

        return [$validated, $validatedTimeSlot];
    }
}
