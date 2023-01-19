<?php
/*
 * Copyright 2014 Google Inc.
 *
 * Licensed under the Apache License, Version 2.0 (the "License"); you may not
 * use this file except in compliance with the License. You may obtain a copy of
 * the License at
 *
 * http://www.apache.org/licenses/LICENSE-2.0
 *
 * Unless required by applicable law or agreed to in writing, software
 * distributed under the License is distributed on an "AS IS" BASIS, WITHOUT
 * WARRANTIES OR CONDITIONS OF ANY KIND, either express or implied. See the
 * License for the specific language governing permissions and limitations under
 * the License.
 */

namespace Google\Service\Contentwarehouse;

class VideoContentSearchBleurtFeatures extends \Google\Model
{
  /**
   * @var string
   */
  public $candidate;
  /**
   * @var string
   */
  public $reference;

  /**
   * @param string
   */
  public function setCandidate($candidate)
  {
    $this->candidate = $candidate;
  }
  /**
   * @return string
   */
  public function getCandidate()
  {
    return $this->candidate;
  }
  /**
   * @param string
   */
  public function setReference($reference)
  {
    $this->reference = $reference;
  }
  /**
   * @return string
   */
  public function getReference()
  {
    return $this->reference;
  }
}

// Adding a class alias for backwards compatibility with the previous class name.
class_alias(VideoContentSearchBleurtFeatures::class, 'Google_Service_Contentwarehouse_VideoContentSearchBleurtFeatures');
