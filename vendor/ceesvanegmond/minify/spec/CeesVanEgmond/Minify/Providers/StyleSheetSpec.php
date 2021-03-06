<?php namespace spec\CeesVanEgmond\Minify\Providers;

use PhpSpec\ObjectBehavior;
use Prophecy\Argument;
use org\bovigo\vfs\vfsStream;

class StyleSheetSpec extends ObjectBehavior
{
    function it_is_initializable()
    {
        $this->shouldHaveType('CeesVanEgmond\Minify\Providers\StyleSheet');
    }

    function it_adds_one_file()
    {
        vfsStream::setup('css',null, array(
            '1.css' => 'a',
        ));

        $this->add(VfsStream::url('css'));
        $this->shouldHaveCount(1);
    }

    function it_adds_multiple_files()
    {
        vfsStream::setup('root',null, array(
            '1.css' => 'a',
            '2.css' => 'b',
        ));

        $this->add(array(
            VfsStream::url('root/1.css'),
            VfsStream::url('root/2.css')
        ));

        $this->shouldHaveCount(2);
    }

    function it_adds_custom_attributes()
    {
        $this->tag('file', array('foobar' => 'baz'))
            ->shouldReturn('<link foobar="baz" href="file" rel="stylesheet">' . PHP_EOL);
    }

    function it_adds_without_custom_attributes()
    {
        $this->tag('file')
            ->shouldReturn('<link href="file" rel="stylesheet">' . PHP_EOL);
    }

    function it_throws_exception_when_file_not_exists()
    {
        $this->shouldThrow('CeesVanEgmond\Minify\Exceptions\FileNotExistException')
            ->duringAdd('foobar');
    }

    function it_should_throw_exception_when_buildpath_not_exist()
    {
        $this->shouldThrow('CeesVanEgmond\Minify\Exceptions\DirNotExistException')
            ->duringMake('bar');
    }

    function it_should_throw_exception_when_buildpath_not_writable()
    {
        vfsStream::setup('css',0555, array());

        $this->shouldThrow('CeesVanEgmond\Minify\Exceptions\DirNotWritableException')
            ->duringMake(vfsStream::url('css'));
    }

    function it_minifies_multiple_files()
    {
        vfsStream::setup('root',null, array(
            'output' => array(),
            '1.css' => 'a',
            '2.css' => 'b',
        ));

        $this->add(vfsStream::url('root/1.css'));
        $this->add(vfsStream::url('root/2.css'));

        $this->make(vfsStream::url('root/output'));

        $this->getAppended()->shouldBe('ab');

        $output = md5('vfs://root/1.css-vfs://root/2.css');
        $filemtime = filemtime(vfsStream::url('root/1.css')) + filemtime(vfsStream::url('root/2.css'));
        $extension = '.css';

        $this->getFilename()->shouldBe($output . $filemtime . $extension);
    }
}
