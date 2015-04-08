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

namespace Hoa\Compiler\Llk\Sampler;

use Hoa\Compiler;
use Hoa\Core;
use Hoa\Visitor;

/**
 * Class \Hoa\Compiler\Llk\Sampler.
 *
 * Sampler parent.
 *
 * @author     Frédéric Dadeau <frederic.dadeau@femto-st.fr>
 * @author     Ivan Enderlin <ivan.enderlin@hoa-project.net>
 * @copyright  Copyright © 2007-2015 Frédéric Dadeau, Ivan Enderlin.
 * @license    New BSD License
 */

abstract class Sampler {

    /**
     * Compiler.
     *
     * @var \Hoa\Compiler\Llk\Parser object
     */
    protected $_compiler         = null;

    /**
     * Tokens.
     *
     * @var \Hoa\Compiler\Llk\Sampler array
     */
    protected $_tokens           = null;

    /**
     * All rules (from the compiler).
     *
     * @var \Hoa\Compiler\Llk\Sampler array
     */
    protected $_rules            = null;

    /**
     * Token sampler.
     *
     * @var \Hoa\Visitor\Visit object
     */
    protected $_tokenSampler     = null;

    /**
     * Root rule name.
     *
     * @var \Hoa\Compiler\Llk\Sampler string
     */
    protected $_rootRuleName     = null;

    /**
     * Current token namespace.
     *
     * @var \Hoa\Compiler\Llk\Sampler string
     */
    protected $_currentNamespace = 'default';



    /**
     * Construct a generator.
     *
     * @access  public
     * @param   \Hoa\Compiler\Llk\Parser  $compiler        Compiler/parser.
     * @param   \Hoa\Visitor\Visit        $tokenSampler    Token sampler.
     * @return  void
     */
    public function __construct ( Compiler\Llk\Parser $compiler,
                                  Visitor\Visit       $tokenSampler ) {

        $this->_compiler     = $compiler;
        $this->_tokens       = $compiler->getTokens();
        $this->_rules        = $compiler->getRules();
        $this->_tokenSampler = $tokenSampler;
        $this->_rootRuleName = $compiler->getRootRule();

        return;
    }

    /**
     * Get compiler.
     *
     * @access  public
     * @return  \Hoa\Compiler\Llk\Parser
     */
    public function getCompiler ( ) {

        return $this->_compiler;
    }

    /**
     * Complete a token (namespace and representation).
     * It returns the next namespace.
     *
     * @access  public
     * @param   \Hoa\Compiler\Llk\Rule\Token  $token    Token.
     * @return  string
     */
    protected function completeToken ( Compiler\Llk\Rule\Token $token ) {

        if(null !== $token->getRepresentation())
            return $this->_currentNamespace;

        $name = $token->getTokenName();
        $token->setNamespace($this->_currentNamespace);
        $toNamespace = $this->_currentNamespace;

        if(isset($this->_tokens[$this->_currentNamespace][$name])) {

            $token->setRepresentation(
                $this->_tokens[$this->_currentNamespace][$name]
            );
        }
        else {

            foreach($this->_tokens[$this->_currentNamespace] as $_name => $regex) {

                if(false === strpos($_name, ':'))
                    continue;

                list($_name, $toNamespace) = explode(':', $_name, 2);

                if($_name === $name)
                    break;
            }

            $token->setRepresentation($regex);
        }

        return $toNamespace;
    }

    /**
     * Set current token namespace.
     *
     * @access  public
     * @param   string  $namespace    Token namespace.
     * @return  string
     */
    protected function setCurrentNamespace ( $namespace ) {

        $old                     = $this->_currentNamespace;
        $this->_currentNamespace = $namespace;

        return $old;
    }

    /**
     * Generate a token value.
     * Complete and set next token namespace.
     *
     * @access  protected
     * @param   \Hoa\Compiler\Llk\Rule\Token  $token    Token.
     * @return  string
     */
    protected function generateToken ( Compiler\Llk\Rule\Token $token ) {

        $toNamespace = $this->completeToken($token);
        $this->setCurrentNamespace($toNamespace);

        return $this->_tokenSampler->visit(
            $token->getAST()
        ) . ' '; // use skip token @TODO
    }
}

/**
 * Flex entity.
 */
Core\Consistency::flexEntity('Hoa\Compiler\Llk\Sampler\Sampler');
