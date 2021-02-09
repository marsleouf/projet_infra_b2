Imports System
Imports System.Threading
Imports System.IO.Ports
Imports System.ComponentModel


Public Class Form1
    '------------------------------------------------
    Dim myPort As Array
    Delegate Sub SetTextCallback(ByVal [text] As String) 'Added to prevent threading errors during receiveing of data
    '------------------------------------------------
    Private Sub Form1_Load(sender As System.Object, e As System.EventArgs) Handles MyBase.Load

        ' myPort = IO.Ports.SerialPort.GetPortNames()
        ' ComboBox1.Items.AddRange(myPort)
        TextBox1.Text = SerialPort1.PortName()

        Button2.Enabled = False

    End Sub
    '------------------------------------------------
    Private Sub ComboBox1_Click(sender As System.Object, e As System.EventArgs) Handles ComboBox1.Click
    End Sub
    '------------------------------------------------
    Private Sub Button1_Click(sender As System.Object, e As System.EventArgs) Handles Button1.Click
        Try
            SerialPort1.PortName = TextBox1.Text
            SerialPort1.BaudRate = ComboBox2.Text
            SerialPort1.Open()
            Button1.Enabled = False
            Button2.Enabled = True
            Button4.Enabled = True
        Catch
            Label3.Text = "er" + TextBox1.Text + ComboBox2.Text
        End Try
    End Sub
    '------------------------------------------------
    Private Sub Button2_Click(sender As System.Object, e As System.EventArgs) Handles Button2.Click

        SerialPort1.Write(RichTextBox1.Text & vbCr) 'concatenate with \n
    End Sub

    Private Sub Button4_Click(sender As System.Object, e As System.EventArgs) Handles Button4.Click
        SerialPort1.Close()
        Button1.Enabled = True
        Button2.Enabled = False
        Button4.Enabled = False
    End Sub

    Private Sub SerialPort1_DataReceived(sender As System.Object, e As System.IO.Ports.SerialDataReceivedEventArgs) Handles SerialPort1.DataReceived
        ReceivedText(SerialPort1.ReadExisting())
    End Sub

    Private Sub ReceivedText(ByVal [text] As String) 'input from ReadExisting
        If Me.RichTextBox2.InvokeRequired Then
            Dim x As New SetTextCallback(AddressOf ReceivedText)
            Me.Invoke(x, New Object() {(text)})
        Else
            Me.RichTextBox2.Text &= [text] 'append text
        End If
    End Sub

    Private Sub Button3_Click(sender As Object, e As EventArgs) Handles Button3.Click

        myPort = IO.Ports.SerialPort.GetPortNames()
        ComboBox1.Items.AddRange(myPort)

    End Sub
End Class
