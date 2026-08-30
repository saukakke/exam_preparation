<?php
declare(strict_types=1);
namespace App\Domains\Identity\Http\Resources;
use Illuminate\Http\Request;
use Illuminate\Http\Resources\Json\JsonResource;
final class UserResource extends JsonResource {
 public function toArray(Request $request): array { return ['id'=>$this->id,'name'=>$this->name,'email'=>$this->email,'phone'=>$this->phone,'status'=>$this->status,'email_verified_at'=>$this->email_verified_at]; }
}