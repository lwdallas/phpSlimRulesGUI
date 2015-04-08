<?php

/**
 * Hoa
 *
 *
 * @license
 *
 * New BSD License
 *
 * Copyright © 2007-2015, Ivan Enderlin. All rights reserved.
 *
 * Redistribution and use in source and binary forms, with or without
 * modification, are permitted provided that the following conditions are met:
 *     * Redistributions of source code must retain the above copyright
 *       notice, this list of conditions and the following disclaimer.
 *     * Redistributions in binary form must reproduce the above copyright
 *       notice, this list of conditions and the following disclaimer in the
 *       documentation and/or other materials provided with the distribution.
 *     * Neither the name of the Hoa nor the names of its contributors may be
 *       used to endorse or promote products derived from this software without
 *       specific prior written permission.
 *
 * THIS SOFTWARE IS PROVIDED BY THE COPYRIGHT HOLDERS AND CONTRIBUTORS "AS IS"
 * AND ANY EXPRESS OR IMPLIED WARRANTIES, INCLUDING, BUT NOT LIMITED TO, THE
 * IMPLIED WARRANTIES OF MERCHANTABILITY AND FITNESS FOR A PARTICULAR PURPOSE
 * ARE DISCLAIMED. IN NO EVENT SHALL THE COPYRIGHT HOLDERS AND CONTRIBUTORS BE
 * LIABLE FOR ANY DIRECT, INDIRECT, INCIDENTAL, SPECIAL, EXEMPLARY, OR
 * CONSEQUENTIAL DAMAGES (INCLUDING, BUT NOT LIMITED TO, PROCUREMENT OF
 * SUBSTITUTE GOODS OR SERVICES; LOSS OF USE, DATA, OR PROFITS; OR BUSINESS
 * INTERRUPTION) HOWEVER CAUSED AND ON ANY THEORY OF LIABILITY, WHETHER IN
 * CONTRACT, STRICT LIABILITY, OR TORT (INCLUDING NEGLIGENCE OR OTHERWISE)
 * ARISING IN ANY WAY OUT OF THE USE OF THIS SOFTWARE, EVEN IF ADVISED OF THE
 * POSSIBILITY OF SUCH DAMAGE.
 */

namespace {

from('Hoa')

/**
 * \Hoa\Stream\Wrapper\Exception
 */
-> import('Stream.Wrapper.Exception')

/**
 * \Hoa\Stream\Wrapper\IWrapper
 */
-> import('Stream.Wrapper.I~.~');

}

namespace Hoa\Stream\Wrapper {

/**
 * Class \Hoa\Stream\Wrapper.
 *
 * Manipulate wrappers.
 *
 * @author     Ivan Enderlin <ivan.enderlin@hoa-project.net>
 * @copyright  Copyright © 2007-2015 Ivan Enderlin.
 * @license    New BSD License
 */

class Wrapper {

    /**
     * Register a wrapper.
     *
     * @access  public
     * @param   string  $protocol     The wrapper name to be registered.
     * @param   string  $classname    Classname which implements the $protocol.
     * @param   int     $flags        Should be set to STREAM_IS_URL if
     *                                $protocol is a URL protocol. Default is 0,
     *                                local stream.
     * @return  bool
     * @throw   \Hoa\Stream\Wrapper\Exception
     */
    public static function register ( $protocol, $classname, $flags = 0 ) {

        if(true === self::isRegistered($protocol))
            throw new Exception(
                'The protocol %s is already registered.', 0, $protocol);

        if(false === class_exists($classname))
            throw new Exception(
                'Cannot register the %s class because it is not found.',
                1, $classname);

        return stream_wrapper_register($protocol, $classname, $flags);
    }

    /**
     * Unregister a wrapper.
     *
     * @access  public
     * @param   string  $protocol    The wrapper name to be unregistered.
     * @return  bool
     */
    public static function unregister ( $protocol ) {

        return stream_wrapper_unregister($protocol);
    }

    /**
     * Restore a previously unregistered build-in wrapper.
     *
     * @access  public
     * @param   string  $protocol    The wrapper name to be restored.
     * @return  bool
     */
    public static function restore ( $protocol ) {

        return stream_wrapper_restore($protocol);
    }

    /**
     * Check if a protocol is registered or not.
     *
     * @access  public
     * @param   string  $protocol    Protocol name.
     */
    public static function isRegistered ( $protocol ) {

        return in_array($protocol, self::getRegistered());
    }

    /**
     * Get all registered wrapper.
     *
     * @access  public
     * @return  array
     */
    public static function getRegistered ( ) {

        return stream_get_wrappers();
    }
}

}

namespace {

/**
 * Flex entity.
 */
Hoa\Core\Consistency::flexEntity('Hoa\Stream\Wrapper\Wrapper');

}
