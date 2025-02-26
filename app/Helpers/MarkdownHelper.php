<?php

namespace App\Helpers;

use League\CommonMark\MarkdownConverter;
use League\CommonMark\CommonMarkConverter;
use League\CommonMark\Node\Block\Paragraph;
use League\CommonMark\Extension\Table\Table;
use League\CommonMark\Environment\Environment;
use League\CommonMark\Extension\CommonMark\Node\Inline\Code;
use League\CommonMark\Extension\CommonMark\Node\Inline\Link;
use League\CommonMark\Extension\CommonMark\Node\Block\Heading;
use League\CommonMark\Extension\CommonMark\Node\Inline\Strong;
use League\CommonMark\Extension\CommonMark\Node\Block\ListItem;
use League\CommonMark\Extension\CommonMark\Node\Block\BlockQuote;
use League\CommonMark\Extension\CommonMark\CommonMarkCoreExtension;
use League\CommonMark\Extension\DefaultAttributes\DefaultAttributesExtension;

class MarkdownHelper
{
    public static function convertToHtml(string $markdown): string
    {
        $config = [
            'default_attributes' => [
                Heading::class => [
                    'class' => static function (Heading $node) {
                        if ($node->getLevel() === 1) {
                            return 'text-lg font-semibold text-black';
                        } else {
                            return null;
                        }
                    },
                ],
                Table::class => [
                    'class' => ['table', 'table-responsive'],
                ],
                Paragraph::class => [
                    'class' => [''],
                ],
                Link::class => [
                    'class' => 'text-blue-500 underline px-1 hover:text-primary-800 duration-500 ease-in-out font-semibold',
                    'target' => '_blank',
                ],
                BlockQuote::class => [
                    'class' => 'border-l-4 text-slate-400 mt-3 p-4   italic border-x-4 border-red-500 rounded-ss-xl rounded-ee-xl',
                ],
                Strong::class => [
                    'class' => 'text-primary-600',
                ],
                Code::class => [
                    'class' => 'block bg-gray-800 text-gray-300 rounded-lg p-4 shadow-lg text-sm font-mono overflow-x-auto',
                ],
                ListItem::class => [
                    'class' => 'list-disc list-inside',
                ],
            ],
        ];
        // Configure the Environment with all the CommonMark parsers/renderers
        $environment = new Environment($config);
        $environment->addExtension(new CommonMarkCoreExtension());

        // Add the extension
        $environment->addExtension(new DefaultAttributesExtension());
        // Instantiate the converter engine and start converting some Markdown!
        $converter = new MarkdownConverter($environment);

        return $converter->convert($markdown);
    }
}
