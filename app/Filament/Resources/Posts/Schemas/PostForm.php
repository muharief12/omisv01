<?php

namespace App\Filament\Resources\Posts\Schemas;

use Filament\Actions\Action;
use Filament\Forms\Components\FileUpload;
use Filament\Forms\Components\RichEditor;
use Filament\Forms\Components\Select;
use Filament\Forms\Components\TextInput;
use Filament\Notifications\Notification;
use Filament\Schemas\Components\Utilities\Get;
use Filament\Schemas\Components\Utilities\Set;
use Filament\Schemas\Schema;
use Gemini\Laravel\Facades\Gemini;

class PostForm
{
    public static function configure(Schema $schema): Schema
    {
        return $schema
            ->components([
                Select::make('post_type_id')
                    ->relationship('postType', 'name')
                    ->required(),
                TextInput::make('title')
                    ->live(onBlur: true)
                    ->suffixAction(
                        Action::make('generate-post-content')
                            ->icon('heroicon-m-sparkles')
                            ->action(function ($state, Get $get, Set $set) {
                                $topic = $state;
                                if (empty($topic)) {
                                    Notification::make()
                                        ->title('Topic is required')
                                        ->body('Please enter a topic to generate content.')
                                        ->warning()
                                        ->send();
                                }

                                try {
                                    $prompt = "Anda adalah seorang Digital Marketer Professional, buatkan konten artikel blog dengan judul : `{$topic}` . Artikel post harus memiliki pendahuluan yang jelas, terdiri dari 3 -4 paragraf, dan ajakan persuasif berupa CTA untuk berkunjung dan belanja ke ABC Coffee Shop. Buat artikel yang menarik, informatif, dan mengandung kata kunci yang relevan untuk SEO. Gunakan bahasa yang mudah dipahami dan hindari penggunaan jargon teknis yang berlebihan. Pastikan artikel memiliki struktur yang baik dengan subjudul yang sesuai. Akhiri artikel dengan kesimpulan yang merangkum poin-poin utama dan memberikan nilai tambah bagi pembaca. Jangan lupa buat dalam tag html dan langsung to the point ke susunan kontennya saja ya.";
                                    $response = Gemini::generativeModel(model: 'gemini-2.0-flash')
                                        ->generateContent($prompt);
                                    $content = $response->text();

                                    if (empty($content)) {
                                        Notification::make()
                                            ->title('No content generated')
                                            ->body('The AI did not return any content. Please try again.')
                                            ->warning()
                                            ->send();
                                    }

                                    $set('content', $content);
                                } catch (\Exception $e) {
                                    Notification::make()
                                        ->title('Error generating content')
                                        ->body('There was an error generating content: ' . $e->getMessage())
                                        ->danger()
                                        ->send();
                                    return;
                                }
                            })
                    )
                    ->required(),
                RichEditor::make('content')
                    ->required()
                    ->columnSpanFull(),
                FileUpload::make('image')
                    ->disk('public')
                    ->directory('post_image')
                    ->required()
                    ->columnSpanFull()
            ]);
    }
}
