<?php
/**
 * Created by PhpStorm.
 * User: james
 * Date: 24/12/15
 * Time: 20:26
 */

namespace CodeProject\Transformers;

use CodeProject\Entities\ProjectMember;
use CodeProject\Entities\User;
use League\Fractal\TransformerAbstract;

class ProjectMemberTransformer extends TransformerAbstract
{

    protected $defaultIncludes = [
        'user'
    ];

    public function transform(User $member)
    {
        return [
            'id' => $member->id,
            'project_id' => $member->project_id
        ];
    }

    public function includeUser(ProjectMember $member){
        return $this->item($member->member, new MemberTransformer());
    }
}