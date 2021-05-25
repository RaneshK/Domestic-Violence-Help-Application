import 'dart:math';
import 'package:flutter/material.dart';
import 'package:flutter/services.dart';
import 'package:flutter_login_ui/screens/login_screen.dart';
import 'package:flutter_login_ui/screens/quiz_screen.dart';
import 'package:flutter_login_ui/utilities/constants.dart';
import 'package:http/http.dart' as http;


class QuizScreen extends StatefulWidget {
  
  String value;
  QuizScreen({this.value});

  @override
  _QuizScreenState createState() => _QuizScreenState(value);
}

class _QuizScreenState extends State<QuizScreen> {


  String value;
  _QuizScreenState(this.value);

  Widget _buildOkayButton() {
   return Container(
      padding: EdgeInsets.symmetric(vertical: 25.0),
      width: double.infinity,
      child: RaisedButton(
        elevation: 5.0,
        onPressed: okayButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.green,
        child: Text(
          questionArray[0].toString(),
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
        onPressed: mediumButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.yellow,
        child: Text(
          questionArray[1].toString(),
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
        onPressed: badButton,
        padding: EdgeInsets.all(15.0),
        shape: RoundedRectangleBorder(
          borderRadius: BorderRadius.circular(30.0),
        ),
        color: Colors.red,
        child: Text(
          questionArray[2].toString(),
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

  // Variables to use in the widgets
  // Stores the postion of the question array
  var arrayPostion;
  var questionArray = [];

  String generateNewQuestionAndAnswers(){

    // Array of questions to display to the user
    var questions = ['Which planet is the hottest in the solar system?', 'Which natural disaster is measured with a Richter scale?', 'What animals are pearls found in?', 'What does BMW stand for?', 'Which country produces the most coffee in the world?'];
    
    // The question to display to the user
    String displayQuestion;

    // Generate a random number
    var random = new Random();

    arrayPostion = random.nextInt(questions.length);
    displayQuestion = questions[arrayPostion];


    // Get the correct answers for the correct question
    var question0Answers = ['Venus', 'Mars', 'Earth']; 
    var question1Answers = ['Tsunamis', 'Cyclones', 'Earthquakes'];
    var question2Answers = ['Prawns', 'Oysters', 'Crabs'];
    var question3Answers = ['Basic Motor Works', 'Bavarian Motor Works', 'Boats Machines Wheels'];
    var question4Answers = ['Australia', 'Brazil', 'Japan'];

    if (arrayPostion == 0){
      questionArray = question0Answers;
    } else if (arrayPostion == 1){
      questionArray = question1Answers;
    } else if (arrayPostion == 2){
      questionArray = question2Answers;
    } else if (arrayPostion == 3){
      questionArray = question3Answers;
    } else if (arrayPostion == 4){
      questionArray = question4Answers;
    }

    return displayQuestion;
  }


  okayButton() async {
    /* 
     The user is not any danger
     Get the user's contact details and send them a SMS or alert that they are okay
    */

    print("The user is okay");

    // Text to append to the url so that the user's id can be retrived from the GET array in php on the server
    String pre = "?id=";

   
    // The location of the file that allows a connection to the database
    var url = "https://localhost/sendSMS.php" + pre + value;

    var sendSMSURL = Uri.parse(url);

    // Append the headers for the request
    Map<String, String> headers = {"Accept":"application/json"};

    // Make GET request
    var response = await http.get(sendSMSURL);

    print("RESPONSE BODY TEXT" + response.body);

    // Copy the response body text to a variable
    String temp = response.body.toString();

    print("This is the url " + url.toString());

    /* 
      Show the user a confirmation after they have choosen a button. (The message has been sent
      to the user's appropriate contacts).
    */
    showDialog(
      context: context,
      builder: (BuildContext context) {
        // return object of type Dialog
        return AlertDialog(
          title: new Text("Thanks for playing"),
          content: new Text("That's correct"),
          actions: <Widget>[
            // usually buttons at the bottom of the dialog
            new ElevatedButton(
              child: new Text("Close"),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  void mediumButton() async {
    /*
     The situation is okay but not too extreme
     Get the user's contact details and send them a SMS or alert that the situation may get out
     hand
    */

    print("The user is alright");

    /* 
      Show the user a confirmation after they have choosen a button. (The message has been sent
      to the user's appropriate contacts).
    */
   // Text to append to the url so that the user's id can be retrived from the GET array in php on the server
    String pre = "?id=";

   
    // The location of the file that allows a connection to the database
    var url = "https://localhost/sendSMS.php" + pre + value;

    var sendSMSURL = Uri.parse(url);

    // Append the headers for the request
    Map<String, String> headers = {"Accept":"application/json"};

    // Make GET request
    var response = await http.get(sendSMSURL);

    print("RESPONSE BODY TEXT" + response.body);

    // Copy the response body text to a variable
    String temp = response.body.toString();

    print("This is the url " + url.toString());

    /* 
      Show the user a confirmation after they have choosen a button. (The message has been sent
      to the user's appropriate contacts).
    */
    showDialog(
      context: context,
      builder: (BuildContext context) {
        // return object of type Dialog
        return AlertDialog(
          title: new Text("Thanks for playing"),
          content: new Text("That's correct"),
          actions: <Widget>[
            // usually buttons at the bottom of the dialog
            new ElevatedButton(
              child: new Text("Close"),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
  }

  void badButton() async {
    /* 
     The situation is really bad and the user may be in great danger
     Get the user's contact details and send them a SMS or alert that the situation is really not 
     good and that they may be in great danger. Possibly alert the appropriate authorities. 
    */

    // Text to append to the url so that the user's id can be retrived from the GET array in php on the server
    String pre = "?id=";

   
    // The location of the file that allows a connection to the database
    var url = "https://localhost/sendSMS.php" + pre + value;

    var sendSMSURL = Uri.parse(url);

    // Append the headers for the request
    Map<String, String> headers = {"Accept":"application/json"};

    // Make GET request
    var response = await http.get(sendSMSURL);

    print("RESPONSE BODY TEXT" + response.body);

    // Copy the response body text to a variable
    String temp = response.body.toString();

    print("This is the url " + url.toString());

    /* 
      Show the user a confirmation after they have choosen a button. (The message has been sent
      to the user's appropriate contacts).
    */
    showDialog(
      context: context,
      builder: (BuildContext context) {
        // return object of type Dialog
        return AlertDialog(
          title: new Text("Thanks for playing"),
          content: new Text("That's correct"),
          actions: <Widget>[
            // usually buttons at the bottom of the dialog
            new ElevatedButton(
              child: new Text("Close"),
              onPressed: () {
                Navigator.of(context).pop();
              },
            ),
          ],
        );
      },
    );
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
                        generateNewQuestionAndAnswers(),
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
