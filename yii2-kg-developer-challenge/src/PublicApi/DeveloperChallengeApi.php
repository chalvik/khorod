<?php

namespace KGorod\DeveloperChallenge\PublicApi;

use yii\base\BaseObject;

/**
 * Открытый API модуля Developer Challenge.
 *
 * @author ilya.vikharev
 */
class DeveloperChallengeApi extends BaseObject 
{
    /**
     * 
     * @return \self
     */
    public static function create(): self
    {
        return new static();
    }
    
    /**
     * 
     * @param int[] $ids
     * @return array
     */
    public function findDeveloperChallengeByIds(array $ids): array
    {
        
    }
}