import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_login_ui/screens/quiz_screen.dart';
import 'package:flutter_login_ui/utilities/constants.dart';
import 'package:flutter_sms/flutter_sms.dart';
import 'package:sms/sms.dart';

class QuizScreen extends StatefulWidget {
  @override
  _QuizScreenState createState() => _QuizScreenState();
}

class _QuizScreenState extends State<QuizScreen> {

  Widget _buildOkayButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: (){
          _sendSMS1();
          showDialog(
              context: context,
              builder: (BuildContext context) => leadDialog);
        },
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.green,
        child: Text(
          'Godzilla',
          style: TextStyle(
            color: Colors.white,
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  Widget _buildMediumButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: (){
          _sendSMS1();
          showDialog(
              context: context,
              builder: (BuildContext context) => leadDialog);
        },
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.yellow,
        child: Text(
          'Batman',
          style: TextStyle(
            color: Color(0xFF527DAA),
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  Widget _buildBadButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: (){
          _sendSMS1();
          showDialog(
              context: context,
              builder: (BuildContext context) => leadDialog);
        },
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.red,
        child: Text(
          'Superman',
          style: TextStyle(
            color: Color(0xFF527DAA),
            letterSpacing: 1.5,
            fontSize: 18.0,
            fontWeight: FontWeight.bold,
            fontFamily: 'OpenSans',
          ),
        ),
      ),
    );
  }

  void okayButton(){
    /*
     The user is not any danger
     Get the user's contact details and send them a SMS or alert that they are okay
    */

    print("The user is okay");

  }

  void mediumButton(){
    /*
     The situation is okay but not too extreme
     Get the user's contact details and send them a SMS or alert that the situation may get out
     hand
    */

    print("The user is alright");

  }

  void badButton(){
    /*
     The situation is really bad and the user may be in great danger
     Get the user's contact details and send them a SMS or alert that the situation is really not
     good and that they may be in great danger. Possibly alert the appropriate authorities.
    */

    print("The user is not okay");

  }

  @override
  Widget build(BuildContext context) {
    return Scaffold(
      body: AnnotatedRegion<SystemUiOverlayStyle>(
        value: SystemUiOverlayStyle.light,
        child: GestureDetector(
          onTap: () => FocusScope.of(context).unfocus(),
          child: Stack(
            children: <Widget>[
              Container(
                height: double.infinity,
                width: double.infinity,
                decoration: BoxDecoration(
                  gradient: LinearGradient(
                    begin: Alignment.topCenter,
                    end: Alignment.bottomCenter,
                    colors: [
                      Color(0xFF73AEF5),
                      Color(0xFF61A4F1),
                      Color(0xFF478DE0),
                      Color(0xFF398AE5),
                    ],
                    stops: [0.1, 0.4, 0.7, 0.9],
                  ),
                ),
              ),
              Container(
                height: double.infinity,
                child: SingleChildScrollView(
                  physics: AlwaysScrollableScrollPhysics(),
                  padding: EdgeInsets.symmetric(
                    horizontal: 40.0,
                    vertical: 120.0,
                  ),
                  child: Column(
                    mainAxisAlignment: MainAxisAlignment.center,
                    children: <Widget>[
                      Text(
                        'Pick a movie',
                        style: TextStyle(
                          color: Colors.white,
                          fontFamily: 'OpenSans',
                          fontSize: 30.0,
                          fontWeight: FontWeight.bold,
                        ),
                      ),
                      SizedBox(height: 30.0),
                     _buildOkayButton(),
                      SizedBox(
                        height: 30.0,
                      ),
                      _buildMediumButton(),
                      _buildBadButton()

                    ],
                  ),
                ),
              )
            ],
          ),
        ),
      ),
    );
  }
}


void _sendSMS(String message, List<String> recipents) async{
  String _result = await sendSMS(message: message, recipients: recipents)
      .catchError((onError) {
    print(onError);
  });
  print(_result);
}

void _sendSMS1() {
  SmsSender sender = new SmsSender();
  String address = "1111111";

  SmsMessage message = new SmsMessage(address, 'Hello flutter!');
  sender.sendSms(message);

}

Dialog leadDialog = Dialog(
  child: Container(
    height: 80.0,
    width: 360.0,
    color: Colors.white,
    child: Column(
      mainAxisAlignment: MainAxisAlignment.end,
      children: <Widget>[
        Padding(
          padding: EdgeInsets.all(15.0),
          child: Text(
            'Message was sent!',
            style:
            TextStyle(color: Colors.black, fontSize: 22.0),
          ),
        ),
      ],
    ),
  ),
);
