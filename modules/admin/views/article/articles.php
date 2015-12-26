<?php

    use giovdk21\yii2SyntaxHighlighter\SyntaxHighlighter as HighLighter;
    use giovdk21\yii2SyntaxHighlighter\SyntaxHighlighter;

    HighLighter::begin([
        'brushes' => ['php', 'bash']
    ]);




?>


    <div class="line number1 index0 alt2"><code class="php plain">somcode</code></div>


    <pre class="brush: php; first-line: 1;"> 321321</pre>

    <pre class="brush:bash;toolbar:false">[root@localhost&nbsp;~]#&nbsp;e2label&nbsp;/dev/sdb1&nbsp;swap
[root@localhost&nbsp;~]#&nbsp;findfs&nbsp;LABEL=swap
/dev/sdb1&nbsp;
[root@localhost&nbsp;~]#&nbsp;mkswap&nbsp;-L&nbsp;swap&nbsp;/dev/sdb
sdb&nbsp;&nbsp;&nbsp;sdb1&nbsp;&nbsp;sdb2&nbsp;&nbsp;sdb5&nbsp;&nbsp;
[root@localhost&nbsp;~]#&nbsp;mkswap&nbsp;-L&nbsp;swap&nbsp;/dev/sdb1
Setting&nbsp;up&nbsp;swapspace&nbsp;version&nbsp;1,&nbsp;size&nbsp;=&nbsp;1011671&nbsp;kB
LABEL=swap,&nbsp;no&nbsp;uuid
[root@localhost&nbsp;~]#&nbsp;swapon&nbsp;-L&nbsp;swap&nbsp;
[root@localhost&nbsp;~]#&nbsp;swapon&nbsp;-s
Filename&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Type&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Size&nbsp;&nbsp;&nbsp;&nbsp;Used&nbsp;&nbsp;&nbsp;&nbsp;Priority
/dev/sdb1&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;partition&nbsp;&nbsp;&nbsp;&nbsp;987956&nbsp;&nbsp;&nbsp;&nbsp;0&nbsp;&nbsp;&nbsp;&nbsp;-2
[root@localhost&nbsp;~]#&nbsp;
LABEL=swap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;swap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;swap&nbsp;&nbsp;&nbsp;&nbsp;defaults&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0&nbsp;0</pre>
    <p><br/></p><p>编辑文件系统信息表:</p>
    <pre class="brush:bash;toolbar:false">[root@localhost&nbsp;~]#&nbsp;vi&nbsp;/etc/fstab</pre><p>在该文件后加入</p>
    <pre class="brush:bash;toolbar:false">LABEL=swap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;swap&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;swap&nbsp;&nbsp;&nbsp;&nbsp;defaults&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;0&nbsp;0</pre>


<?php

SyntaxHighlighter::end();
?>