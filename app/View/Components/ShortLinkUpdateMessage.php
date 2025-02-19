<?php

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;
use Illuminate\Http\Request;

/**
 * Shows message for update status id provided in request.
 */
class ShortLinkUpdateMessage extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(Request $request)
    {
        $this->message = $this->getMessage($request->get('messageId'));
    }

    /**
     * Message data.
     */
    protected ?array $message;

    /**
     * Gets specific message style and text for id.
     *
     * @param string|null $messageId
     *   Id of status set in update redirect response.
     * @return string[]|null
     *   An array of key value or null if id wasn't set.
     */
    protected function getMessage(?string $messageId): ?array {
        return match ($messageId) {
            'record-updated' => [
                'type' => 'success',
                'message' => 'Ссылка обновлена',
            ],
            'record-destroyed' => [
                'type' => 'warning',
                'message' => 'Ссылка удалена',
            ],
            default => null
        };
    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.short-link-update-message', [
            'message' => $this->message
        ]);
    }
}
