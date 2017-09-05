<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01//EN" "http://www.w3.org/TR/html4/strict.dtd">
<HTML>
<HEAD>
<META http-equiv="Content-Type" content="text/html; charset=UTF-8">
<META http-equiv="X-UA-Compatible" content="IE=8">
<TITLE>Report Cards | {{ $stream_current_name }}</TITLE>
<!-- #include virtual="/convert-pdf-to-html/includes/pdf-to-word-head-tag.htm" -->
<META name="generator" content="BCL easyConverter SDK 5.0.08">
<STYLE type="text/css">

body {margin-top: 10px;margin-left: 0px;}

#page_1 {position:relative; overflow: hidden;margin: 15px 0px 0px 20px;padding: 0px;border: none;width: 740px;}
#page_1 #id_1 {border:none;margin: 0px 0px 0px 0px;padding: 0px;border:none;width: 740px;overflow: hidden;}
#page_1 #id_2 {border:none;margin: 80px 0px -100px 196px;padding: 0px;border:none;width: 544px;overflow: hidden;}





.ft0{font: bold 27px 'Arial';line-height: 32px; text-align: center;}
.ft1{font: bold 19px 'Arial';line-height: 22px;}
.ft2{font: 17px 'Arial';line-height: 19px;}
.ft3{font: bold 17px 'Arial';line-height: 19px;}
.ft4{font: bold 16px 'Arial';line-height: 19px;}
.ft5{font: 1px 'Arial';line-height: 3px;}
.ft6{font: 1px 'Arial';line-height: 2px;}
.ft7{font: bold 15px 'Arial';line-height: 18px;}
.ft8{font: 13px 'Arial';color: #999999;line-height: 16px; margin-top: -120px;}

.p0{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p1{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p2{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p3{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p4{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p5{text-align: center;margin-top: 0px;margin-bottom: 0px;}
.p6{text-align: left;margin-top: 0px;margin-bottom: 0px;}
.p7{text-align: left;margin-top: 2px;margin-bottom: 0px;}
.p8{text-align: left;padding-left: 91px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p9{text-align: left;padding-left: 50px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p10{text-align: left;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p11{text-align: left;padding-left: 4px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p12{text-align: center;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p13{text-align: right;padding-right: 3px;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p14{text-align: center;margin-top: 0px;margin-bottom: 0px;white-space: nowrap;}
.p15{text-align: left;margin-top: 16px;margin-bottom: 0px;}
.p16{text-align: left;margin-top: 1px;margin-bottom: 0px;}
.p17{text-align: left;margin-top: 18px;margin-bottom: 0px;}
.p18{text-align: left;padding-left: 290px;margin-top: 10px;margin-bottom: 0px;}

.td0{border-left: #000000 1px solid;border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}
.td1{border-right: #000000 1px solid;border-top: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}
.td2{border-left: #000000 1px solid;border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}
.td3{border-right: #000000 1px solid;border-bottom: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}
.td4{border-left: #000000 1px solid;border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}
.td5{border-right: #000000 1px solid;padding: 0px;margin: 0px;width: 239px;vertical-align: bottom;}

.tr0{height: 26px;}
.tr1{height: 3px;}
.tr2{height: 23px;}
.tr3{height: 24px;}
.tr4{height: 2px;}

.t0{width: 480px;margin-top:0px; margin-left: 75px;font: 17px 'Arial';}

</STYLE>
</HEAD>

<BODY>

@foreach($students as $student)
<DIV id="page_1">


<DIV id="id_1" style="padding-left: 100px; margin-left: -125px;">
<P class="p0 ft0">{{ $school_name }}</P>
<P class="p1 ft1">{{ $school_address }}</P>
<P class="p2 ft1">Tel: {{ $school_phone }}</P>
<P class="p3 ft1">{{ $classesreport_name }}</P>
<P class="p4 ft1">{{ $date }}</P>
<P class="p5 ft1">Report Form</P>
<P class="p6 ft3" style="padding-left: 80px;">Admission No: <NOBR><SPAN class="ft2">{{$student->admission->adm_no}}</SPAN></NOBR></P>
<P class="p6 ft3" style="padding-left: 80px;">Name of Student: <SPAN class="ft2">{{ $student->name }}</SPAN></P>
<P class="p7 ft2" style="padding-left: 80px;"><SPAN class="ft3">Class: </SPAN>{{ $stream_class_name}}, ({{ $stream_current_abbr}})</P>
<TABLE cellpadding=0 cellspacing=0 class="t0" style="padding-left: 30px;">
<TR>
	<TD class="tr0 td0"><P class="p8 ft4">Subjects</P></TD>
	<TD class="tr0 td1"><P class="p9 ft4">Examination Marks</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p11 ft2">Mathematics</P></TD>
	<TD class="tr2 td5"><P class="p12 ft3">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getMathsTotalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">English</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name', 'English')->first()->marks }}/{{ $student->grades->where('assessment.name','English')->first()->assessment->out_of }}</P></TD>
</TR>
<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">Composition</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name', 'Composition')->first()->marks }}/{{ $student->grades->where('assessment.name','Composition')->first()->assessment->out_of }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p13 ft3">Total</P></TD>
	<TD class="tr2 td5"><P class="p14 ft3">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getEnglishTotalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">Kiswahili</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name','Kiswahili')->first()->marks }}/{{ $student->grades->where('assessment.name','Kiswahili')->first()->assessment->out_of }}</P></TD>
</TR>
<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">Insha</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name','Insha')->first()->marks }}/{{ $student->grades->where('assessment.name','Insha')->first()->assessment->out_of }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p13 ft3">Jumla</P></TD>
	<TD class="tr2 td5"><P class="p12 ft3">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getKiswaTotalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">Science</P></TD>
	<TD class="tr3 td5"><P class="p12 ft3">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getScienceTotalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">Social Studies</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name','Social Studies')->first()->marks }}/{{ $student->grades->where('assessment.name','Social Studies')->first()->assessment->out_of }}</P></TD>
</TR>

@if(count($student->grades->where('assessment.name','C.R.E')->first())>0)
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>

<TR>
	<TD class="tr2 td4"><P class="p11 ft2">C.R.E</P></TD>
	<TD class="tr2 td5"><P class="p12 ft2">{{ $student->grades->where('assessment.name','C.R.E')->first()->marks }}/{{ $student->grades->where('assessment.name','C.R.E')->first()->assessment->out_of }}</P></TD>
</TR> 
@endif

@if(count($student->grades->where('assessment.name','I.R.E')->first())>0)
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">I.R.E</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">@if(count($student->grades->where('assessment.name','I.R.E')->first())>0){{ $student->grades->where('assessment.name','I.R.E')->first()->marks }}/{{ $student->grades->where('assessment.name','I.R.E')->first()->assessment->out_of }} @endif</P></TD>
</TR>
@endif

@if(count($student->grades->where('assessment.name','H.R.E')->first())>0)
<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2">H.R.E</P></TD>
	<TD class="tr3 td5"><P class="p12 ft2">@if(count($student->grades->where('assessment.name','H.R.E')->first())>0){{ $student->grades->where('assessment.name','H.R.E')->first()->marks }}/{{ $student->grades->where('assessment.name','H.R.E')->first()->assessment->out_of }} @endif</P></TD>
</TR>
@endif

<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p13 ft3">Total</P></TD>
	<TD class="tr2 td5"><P class="p12 ft3">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getSocialStudiesTotalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>

<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p11 ft2"></P></TD>
	<TD class="tr3 td5"><P class="p12 ft2"></P></TD>
</TR>

<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p13 ft3">Exam Total</P></TD>
	<TD class="tr3 td5"><P class="p12 ft7">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getFinalReportMarks($student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr4 td2"><P class="p10 ft6">&nbsp;</P></TD>
	<TD class="tr4 td3"><P class="p10 ft6">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr3 td4"><P class="p13 ft3">Stream Position</P></TD>
	<TD class="tr3 td5"><P class="p12 ft4">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getStudentStreamPosition($students, $student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
<TR>
	<TD class="tr2 td4"><P class="p13 ft3">Class Position</P></TD>
	<TD class="tr2 td5"><P class="p12 ft4">{{ chillimarks\Http\Controllers\Core\Reports\PrimaryReportsCardsController::getStudentClassesPosition($classes_students, $student->id, $classesreport_id) }}</P></TD>
</TR>
<TR>
	<TD class="tr1 td2"><P class="p10 ft5">&nbsp;</P></TD>
	<TD class="tr1 td3"><P class="p10 ft5">&nbsp;</P></TD>
</TR>
</TABLE>
<P class="p15 ft4" style="padding-left: 60px; padding-top: 40px;">Teacher's Remarks:</P>
<P class="p15 ft4" style="padding-left: 60px;">…………………………………………………………………Signature:……………...Date….………</P>
<P class="p16 ft4" style="padding-left: 60px;">Principal’s Remarks:</P>
<P class="p17 ft4" style="padding-left: 60px;">…………………………………………………………………Signature:...……………Date………….</P>
<P class="p18 ft4">Official School Stamp</P>
</DIV>
<DIV id="id_2">
<P class="p6 ft8"></P>
</DIV>
</DIV>
@endforeach

</BODY>
</HTML>
