Sub AutoGetContent(item As MailItem)
    Debug.Print ("receive an email")
    Dim id As String
    Dim SubjectString As String
    Dim sender As String
    Dim email As Outlook.MailItem
    Dim content As String

    On Error GoTo Err

    id = item.EntryID                   ' 先获取邮件的ID
    Set email = Application.Session.GetItemFromID(id)
    SubjectString = email.Subject       ' 邮件主题
    sender = email.SenderEmailAddress   ' 邮件的发送人地址
    Debug.Print ("new email arrivaved: subject is " & SubjectString & "  sender is " & sender)

    ' 校验主题，这里是对主题做过滤，不合适的直接返回不处理
    Dim index As Integer
    index = InStr(SubjectString, "银行申请")
    If 0 = index Then
        index = InStr(SubjectString, "银行申请")
        If 0 = index Then
            Return
        End If
        Return
    End If
    
    ' 打开文件
    Dim FilePath As String
    FilePath = "E:\邮件提取结果123.txt"
    
    Open FilePath For Append As #1

    '定义正则表达式对象
    Dim oRegExp As Object
    '定义匹配字符串集合对象
    Dim oMatches As Object
    '创建正则表达式
    '定义要执行正则查找的文本变量
    Dim sText As String
    sText = item.Body
    Set oRegExp = CreateObject("vbscript.regexp")
    With oRegExp
        '设置是否匹配所有的符合项，True表示匹配所有, False表示仅匹配第一个符合项
        .Global = True
        '设置是否区分大小写，True表示不区分大小写, False表示区分大小写
        .IgnoreCase = True
        '设置要查找的字符模式
        .Pattern = "银行: (.*?) 电话: (\d+) 名字: (.*?) 地点: (.*?) 时间: (.*?)\s"
        '判断是否可以找到匹配的字符，若可以则返回True
        'MsgBox .Test(sText)
        '对字符串执行正则查找，返回所有的查找值的集合，若未找到，则为空
        Set oMatches = .Execute(sText)
        '把字符串中用正则找到的所有匹配字符替换为其它字符
        For Each mMatch In oMatches
             'MsgBox mMatch.Value
             Print #1, mMatch.Value
             'Print #1, mMatch.Value
         Next
         'MsgBox omMatches
        'MsgBox .Replace(sText, "")
    End With
    Set oRegExp = Nothing
    Set oMatches = Nothing

     'Print #1, item.Body

     'Debug.Print ("content:" & item.Body)
    
    Close 1
    

Err:

End Sub
