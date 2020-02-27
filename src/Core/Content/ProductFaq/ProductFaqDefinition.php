<?php declare(strict_types=1);

namespace KuzmanProductFaq\Core\Content\ProductFaq;

use Shopware\Core\Framework\DataAbstractionLayer\EntityDefinition;
use Shopware\Core\Framework\DataAbstractionLayer\Field\BoolField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\PrimaryKey;
use Shopware\Core\Framework\DataAbstractionLayer\Field\Flag\Required;
use Shopware\Core\Framework\DataAbstractionLayer\Field\IdField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\LongTextField;
use Shopware\Core\Framework\DataAbstractionLayer\Field\StringField;
use Shopware\Core\Framework\DataAbstractionLayer\FieldCollection;

class ProductFaqDefinition extends EntityDefinition
{
    public function getEntityName(): string
    {
        return 'kuzman_product_faq';
    }

    public function getCollectionClass(): string
    {
        return ProductFaqCollection::class;
    }

    public function getEntityClass(): string
    {
       return ProductFaqEntity::class;
    }

    protected function defineFields(): FieldCollection
    {
        /*
         * IdField id
         * BoolField active
         * StringField email
         * StringField nickname
         * LongTextField question
         * LongTextField answer
         * StringField product_number
         *
         * required: active email active nickname question
         */
        return new FieldCollection(
            [
                (new IdField('id', 'id'))->addFlags(new Required(), new PrimaryKey()),
                (new BoolField('active', 'active'))->addFlags(new Required()),
                (new StringField('email', 'email'))->addFlags(new Required()),
                (new StringField('nickname', 'nickname'))->addFlags(new Required()),
                (new LongTextField('question', 'question'))->addFlags(new Required()),
                new LongTextField('answer', 'answer'),
                new StringField('product_number', 'product_number')
            ]
        );
    }
}
