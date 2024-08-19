<?php

namespace App\Livewire;

use Livewire\Component;
use Filament\Forms\Form;
use Filament\Forms\Contracts\HasForms;
use Illuminate\Support\Facades\Storage;
use Filament\Forms\Concerns\InteractsWithForms;
use Filament\Notifications\Notification;

class Setting extends Component implements HasForms
{
    use InteractsWithForms;
    public $data = [];
    public function render()
    {
        return view('livewire.setting');
    }
    public function mount(): void
    {
        $this->data = $this->loadSettings();
        $this->form->fill($this->loadSettings());
    }

    protected function loadSettings(): array
    {
        $settings = Storage::get('settings.json');
        return json_decode($settings, true) ?? [];
    }

    protected function saveSettings(array $data): void
    {
        $settings = json_encode($data, JSON_PRETTY_PRINT);
        Storage::put('settings.json', $settings);
    }

    public function form(Form $form)
    {
        return $form->schema([
            \Filament\Forms\Components\ToggleButtons::make('maintenance')->options([true => 'YA',false=>'TIDAK'])->inline(),
            \Filament\Forms\Components\TextInput::make('site_name'),
            \Filament\Forms\Components\TextInput::make('site_description'),
            \Filament\Forms\Components\FileUpload::make('icon')->image()->imageEditor()->avatar(),
            \Filament\Forms\Components\FileUpload::make('logo')->image()->imageEditor(),
            \Filament\Forms\Components\Textarea::make('address'),
            \Filament\Forms\Components\RichEditor::make('about'),

            \Filament\Forms\Components\Section::make('Sosial Media')->schema([
                \Filament\Forms\Components\TextInput::make('sosmed.facebook_url'),
                \Filament\Forms\Components\TextInput::make('sosmed.instagram_url'),
                \Filament\Forms\Components\TextInput::make('sosmed.whatsapp_url')
            ]),
            \Filament\Forms\Components\Section::make('Tombol Pesan')->schema([
                \Filament\Forms\Components\TextInput::make('no_whatsapp'),
                \Filament\Forms\Components\Textarea::make('wa_message'),
            ])

        ])->statePath('data');
    }

    public function submit()
    {
        $data = $this->form->getState('data');
        $this->saveSettings($data);

        Notification::make('success')->icon('heroicon-o-check-circle')->body('Successfully save settings!')->color('success')->send();
    }
}
